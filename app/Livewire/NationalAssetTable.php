<?php

namespace App\Livewire;

use App\Models\Classification;
use App\Models\NationalAsset;
use App\Models\Component;
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
use PowerComponents\LivewirePowerGrid\Traits\WithExport;  
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable; 
// Eliminamos la importación de Redirector si ya no la necesitamos para el tipo de retorno explícito.
use Livewire\Features\SupportRedirects\Redirector;


final class NationalAssetTable extends PowerGridComponent
{
    use WithExport; 
    public string $tableName = 'national-asset-table-ohcfbf-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'bienes_nacionales_reporte') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->columnWidth([
                        2 => 30,
                        3 => 15,
                        4 => 55,
                        8 => 55,
                        9 => 55,
                        11 => 55,
                    ])
        ];
    }

    public function datasource(): Builder
    {
             $user = auth()->user(); // Get the authenticated user
         $query = NationalAsset::query()
             ->join('classifications', 'national_assets.classification_id', '=', 'classifications.id')
             ->join('departments', 'national_assets.department_id', '=', 'departments.id')
             ->select(
                 'national_assets.*',
                 'classifications.name as classification_name',
                 'classifications.brand as classification_brand',
                 'classifications.model as classification_model',
                 'departments.name as department_name'
             );

         // Determine user's role
         $userRoleName = null;
         if ($user && $user->roles->isNotEmpty()) {
             $userRoleName = $user->roles->first()->name;
         }

         // Apply the role-based filtering based on the Staff model
         /*switch ($userRoleName) {
             case 'Admin':
                 // Admins see all national assets. No additional WHERE clause needed.
                 break;

             case 'Coord':
             case 'Normal':
                 // For Coord or Normal roles, get the staff record linked to the user
                 $loggedInStaff = Staff::where('user_id', $user->id)->first();

                 // If a staff record exists and has a department_id, apply the filter
                 if ($loggedInStaff && $loggedInStaff->department_id) {
                     $departmentId = $loggedInStaff->department_id;
                     $query->where('national_assets.department_id', $departmentId);
                 } else {
                     // If no staff record or no department_id, return an empty query
                     // to prevent showing any assets.
                     $query->whereRaw('1 = 0'); // This is a common way to force an empty result set
                 }
                 break;

             default:
                 // For any other role or no role, return an empty query.
                 $query->whereRaw('1 = 0');
                 break;
         }
    */
         return $query;
    }

    public function relationSearch(): array
    {
        return [
            'department' => ['name'],
            'classification' => ['name', 'brand', 'model']
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('code')
            ->add('serial')
            ->add('typeNA')
            // Estos campos ahora se refieren a los alias creados en el método datasource()
            ->add('classification_name') // Ya no necesita la función anónima porque se selecciona directamente
            ->add('classification_brand')
            ->add('classification_model')
            ->add('department_name') // Ya no necesita la función anónima
            ->add('description')
            ->add('responsible_for_use')
            ->add('status')
            ->add('observations')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->visibleInExport(false),

            Column::make('Bien Nacional', 'code')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Serial', 'serial')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Tipo', 'typeNA')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Descripcion', 'description')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            // Las columnas ahora se refieren a los alias del SELECT en datasource()
            // Y para el filtrado/búsqueda/ordenamiento, se usa el nombre real de la columna en la tabla unida
            Column::make('Clasificacion', 'classification_name', 'classifications.name')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Marca', 'classification_brand', 'classifications.brand')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Modelo', 'classification_model', 'classifications.model')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Departamento', 'department_name', 'departments.name') // Usar el alias y el nombre real de la columna para PowerGrid
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Responsable de uso', 'responsible_for_use')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Estatus', 'status')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Observaciones', 'observations')
                ->visibleInExport(true)
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->visibleInExport(false)
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('code')->operators(['contains']),

            Filter::inputText('serial')->operators(['contains']),

            Filter::select('typeNA', 'typeNA')
                ->dataSource(NationalAsset::select('typeNA')->distinct()->get())
                ->optionValue('typeNA')
                ->optionLabel('typeNA'),

            // Filtro por nombre de departamento - ahora se filtra por el 'id' de la relación
            // ya que un activo pertenece a un departamento.
            Filter::select('departments.name', 'department_id') // Usar el nombre de la columna de la tabla unida
                ->dataSource(\App\Models\Department::all())
                ->optionValue('id')
                ->optionLabel('name'),

            // --- Filtros Independientes para Classification (Ahora usan el nombre de la columna unida) ---

           // Filtro por Nombre de Clasificación, filtrado por tipos específicos.
            Filter::select('classifications.name')
                ->dataSource(Classification::whereIn('type', ['Mobiliario', 'Oficina', 'Tecnologico'])->select('name')->distinct()->get())
                ->optionValue('name')
                ->optionLabel('name'),

            // Filtro por Marca de Clasificación, filtrado por tipos específicos.
            Filter::select('classifications.brand')
                ->dataSource(Classification::whereIn('type', ['Mobiliario', 'Oficina', 'Tecnologico'])->select('brand')->distinct()->get())
                ->optionValue('brand')
                ->optionLabel('brand'),

            // Filtro por Modelo de Clasificación, filtrado por tipos específicos.
            Filter::select('classifications.model')
                ->dataSource(Classification::whereIn('type', ['Mobiliario', 'Oficina', 'Tecnologico'])->select('model')->distinct()->get())
                ->optionValue('model')
                ->optionLabel('model'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    // Cambiamos el tipo de retorno a `void` y removemos el `return` explícito para `redirect()`
    public function edit($rowId): void
    {
        // Livewire manejará la redirección sin necesidad de un `return` explícito aquí.
        redirect()->route('admin.national_assets.edit', ['national_asset' => $rowId]);
    }

    #[\Livewire\Attributes\On('show')]
    // Cambiamos el tipo de retorno a `void` y removemos el `return` explícito para `redirect()`
    public function show($rowId): void
    {
        // Livewire manejará la redirección sin necesidad de un `return` explícito aquí.
        redirect()->route('admin.national_assets.show', ['national_asset' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $nationalAsset = NationalAsset::find($rowId);

        if (!$nationalAsset) {
            // Si el activo no se encuentra, quizás ya fue eliminado.
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => 'Bien Nacional no encontrado',
                'text' => 'El bien nacional que intentas eliminar ya no existe.'
            ]);
            $this->redirect(route('admin.national_assets.index'), navigate: true);
            return;
        }

        // --- NEW CHECK START ---
        // Check if any Component has the same code as the NationalAsset
        $componentWithSameCode = Component::where('code', $nationalAsset->code)->first();

        if ($componentWithSameCode) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar Bien Nacional',
                'text' => 'Este bien nacional está asociado a un componente con el código ' . $nationalAsset->code . '. Elimina primero el componente asociado.'
            ]);
            $this->redirect(route('admin.national_assets.index'), navigate: true);
            return;
        }

        try {
            $nationalAsset->delete();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Eliminación del Bien Nacional: ' . $nationalAsset->code,
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
        $this->redirect(route('admin.national_assets.index'), navigate: true);
    }

    public function actions(NationalAsset $row): array
    {
        return [
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-block align-text-bottom mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>Edit') // Puedes simplificar el texto del botón
                ->id()
                ->class('btn-outline-yellow text-xs')
                ->dispatch('edit', ['rowId' => $row->id])
                ->can(auth()->user()->can('admin.national_assets.edit')), // <-- Aquí aplicamos la lógica de permisos

            Button::add('show')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-block align-text-bottom mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>Show') // Puedes simplificar el texto del botón
                ->id()
                ->class('btn-outline-gray text-xs')
                ->dispatch('show', ['rowId' => $row->id])
                ->can(auth()->user()->can('admin.national_assets.show')), // <-- Aquí aplicamos la lógica de permisos

            Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-block align-text-bottom mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>Eliminar')
                ->id()
                ->class('btn-outline-red text-xs')
                ->dispatch('delete-confirm', ['rowId' => $row->id])
                ->can(auth()->user()->can('admin.national_assets.destroy')), // <-- Aquí aplicamos la lógica de permisos
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
