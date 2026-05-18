<?php

namespace App\Livewire;

use App\Models\Component;
use App\Models\Classification;
use App\Models\Staff;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ComponentV2Table extends PowerGridComponent
{
    public string $tableName = 'component-v2-table-usyyix-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Component::query()
            ->with([
                'motherboard',
                'processor',
                'harddisk',
                'videoCard',
                'audioCard'
            ]);
    }

    public function relationSearch(): array
    {
        return [
            'motherboard.name' => 'name',
            'processor.name' => 'name',
            'harddisk.name' => 'name',
            'videoCard.name' => 'name',
            'audioCard.name' => 'name',
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('code')
            ->add('motherboard_name', function (Component $component) {
                if ($component->motherboard) {
                    return $component->motherboard->brand . '->' . $component->motherboard->model;
                }
                return 'Sin especificar';
            })
            ->add('mac_address')
            // Using a conditional to return "Sin especificar" if any part of the processor name is null
            ->add('processor_name', function (Component $component) {
                if ($component->processor) {
                    return $component->processor->name . '->' . $component->processor->brand . '->' . $component->processor->model;
                }
                return 'Sin especificar';
            })
            ->add('ram')
            // Using a conditional for harddisk
            ->add('harddisk_name', function (Component $component) {
                if ($component->harddisk) {
                    return $component->harddisk->brand . '->' . $component->harddisk->model;
                }
                return 'Sin especificar';
            })
            // Using a conditional for videoCard
            ->add('video_card_name', function (Component $component) {
                if ($component->videoCard) {
                    return $component->videoCard->brand . '->' . $component->videoCard->model;
                }
                return 'Sin especificar';
            })
            // Using a conditional for audioCard
            ->add('audio_card_name', function (Component $component) {
                if ($component->audioCard) {
                    return $component->audioCard->brand . '->' . $component->audioCard->model;
                }
                return 'Sin especificar';
            })
            ->add('sos_names', function (Component $component) {
                if (is_array($component->sos) && count($component->sos) > 0) {
                    $sosDetails = Classification::whereIn('id', $component->sos)
                                    ->get()
                                    ->map(function ($classification) {
                                        return $classification->brand . ' ' . $classification->name . ' ' . $classification->model;
                                    })
                                    ->implode("<br>");
                    return $sosDetails ?: 'N/A';
                }
                return 'Sin especificar';
            })
            // Fetch and format 'ofimatics' names, brands, and models
            ->add('ofimatics_names', function (Component $component) {
                if (is_array($component->ofimatics) && count($component->ofimatics) > 0) {
                    $ofimaticsDetails = Classification::whereIn('id', $component->ofimatics)
                                        ->get()
                                        ->map(function ($classification) {
                                            return $classification->brand . ' ' . $classification->name . ' ' . $classification->model;
                                        })
                                        ->implode("<br>");
                    return $ofimaticsDetails ?: 'N/A';
                }
                return 'Sin especificar';
            })
            // Fetch and format 'navegators' names
            ->add('navegators_names', function (Component $component) {
                if (is_array($component->navegators) && count($component->navegators) > 0) {
                    $navegatorsDetails = Classification::whereIn('id', $component->navegators)
                                        ->get()
                                        ->map(function ($classification) {
                                            return $classification->name . ' ' . $classification->brand . ' ' . $classification->model;
                                        })
                                        ->implode("<br>");
                    return $navegatorsDetails ?: 'N/A';
                }
                return 'Sin especificar';
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Code', 'code')
                ->sortable()
                ->searchable(),

            // Muestra el nombre de la placa base
            Column::make('Motherboard', 'motherboard_name')
                ->sortable() // Puedes ordenar por el nombre si la relación de búsqueda está configurada
                ->searchable(), // Puedes buscar por el nombre si la relación de búsqueda está configurada

            Column::make('Mac address', 'mac_address')
                ->sortable()
                ->searchable(),

            // Muestra el nombre del procesador
            Column::make('Processor', 'processor_name')
                ->sortable()
                ->searchable(),

            Column::make('Ram', 'ram')
                ->sortable()
                ->searchable(),

            // Muestra el nombre del disco duro
            Column::make('Harddisk', 'harddisk_name')
                ->sortable()
                ->searchable(),

            // Muestra el nombre de la tarjeta de video
            Column::make('Video Card', 'video_card_name')
                ->sortable()
                ->searchable(),

            // Muestra el nombre de la tarjeta de audio
            Column::make('Audio Card', 'audio_card_name')
                ->sortable()
                ->searchable(),
           Column::make('Sos', 'sos_names')
                ->sortable()
                ->searchable(),

            Column::make('Ofimatics', 'ofimatics_names')
                ->sortable()
                ->searchable(),

            Column::make('Navegators', 'navegators_names')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('code')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        // Livewire manejará la redirección sin necesidad de un `return` explícito aquí.
        redirect()->route('admin.components.edit', ['component' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $component = Component::find($rowId);

        if (!$component) {
            // Si el activo no se encuentra, quizás ya fue eliminado.
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => 'Bien Nacional no encontrado',
                'text' => 'El bien nacional que intentas eliminar ya no existe.'
            ]);
            $this->redirect(route('admin.components.index'), navigate: true);
            return;
        }

        try {
            $component->delete();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Eliminación del Bien Nacional: ' . $component->code,
                'text' => 'Se ha realizado con éxito'
            ]);

        } catch (QueryException $e) {
            // Manejo específico para excepciones de consultas de base de datos, ej. restricciones de clave foránea
            // El código de error '23000' es común para violaciones de integridad de datos (incluidas las claves foráneas)
            if ($e->getCode() == '23000') {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => 'Error al eliminar Bien Nacional',
                    'text' => 'El bien nacional tiene registros asociados (ej., en movimientos o asignaciones) y no puede ser eliminado directamente.'
                ]);
            } else {
                // Para otros errores de base de datos no relacionados con claves foráneas
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => 'Error en la base de datos',
                    'text' => 'Ocurrió un error inesperado en la base de datos: ' . $e->getMessage()
                ]);
            }
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción genérica
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error inesperado',
                'text' => 'Ocurrió un error inesperado al intentar eliminar el bien nacional: ' . $e->getMessage()
            ]);
        }

        // Siempre redirigir después de la acción, ya sea exitosa o no
        $this->redirect(route('admin.components.index'), navigate: true);
    }

    public function actions(Component $row): array
    {
        return [
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-block align-text-bottom mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>Edit') // Puedes simplificar el texto del botón
                ->id()
                ->class('btn-outline-yellow text-xs')
                ->dispatch('edit', ['rowId' => $row->id])
                ->can(auth()->user()->can('admin.components.edit')), // <-- Aquí aplicamos la lógica de permisos

            Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-block align-text-bottom mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>Eliminar')
                ->id()
                ->class('btn-outline-red text-xs')
                ->dispatch('delete-confirm', ['rowId' => $row->id])
                ->can(auth()->user()->can('admin.components.destroy')), // <-- Aquí aplicamos la lógica de permisos
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
