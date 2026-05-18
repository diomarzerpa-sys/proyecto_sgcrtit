<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.components.index')">Especificar Componentes</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="card">
        <form action="{{route('admin.components.store')}}" method="POST" class="space-y-4">
            @csrf
            
            <flux:input label="Bien Nacional:" name="code" value="{{old('code')}}" placeholder="Escriba el bien nacional." />
            
            <flux:select label='Tarjeta Madre:' name="motherboard_id" placeholder="Elija por favor...">
                @foreach ($motherboards as $motherboard)
                    <flux:select.option value="{{$motherboard->id}}" :selected="$motherboard->id == old('motherboard_id')">{{$motherboard->name.'->'.$motherboard->brand.'->'.$motherboard->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="Direccion MAC:" name="mac_address" value="{{old('mac_address')}}" placeholder="Escriba la direccion mac del equipo." />

            <flux:select label='Procesador:' name="processor_id" placeholder="Elija por favor...">
                @foreach ($processors as $processor)
                    <flux:select.option value="{{$processor->id}}" :selected="$processor->id == old('processor_id')">{{$processor->name.'->'.$processor->brand.'->'.$processor->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input label="RAM:" name="ram" value="{{old('ram')}}" placeholder="Escriba el bien nacional." />

            <flux:select label='Disco Duro:' name="harddisk_id" placeholder="Elija por favor...">
                @foreach ($harddisks as $harddisk)
                    <flux:select.option value="{{$harddisk->id}}" :selected="$harddisk->id == old('harddisk_id')">{{$harddisk->name.'->'.$harddisk->brand.'->'.$harddisk->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select label='Tarjeta de Video:' name="video_card_id" placeholder="Elija por favor...">
                @foreach ($videocards as $videocard)
                    <flux:select.option value="{{$videocard->id}}" :selected="$videocard->id == old('video_card_id')">{{$videocard->name.'->'.$videocard->brand.'->'.$videocard->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select label='Tarjeta de Audio:' name="audio_card_id" placeholder="Elija por favor...">
                @foreach ($audiocards as $audiocard)
                    <flux:select.option value="{{$audiocard->id}}" :selected="$audiocard->id == old('audio_card_id')">{{$audiocard->name.'->'.$audiocard->brand.'->'.$audiocard->model}}</flux:select.option>
                @endforeach
            </flux:select>

            <div>
                <p class="font-medium text-sm mb-1">Sistema Operativo:</p>
            </div>

            @php
            $contador = 0;
            $sos_por_columna = ceil(count($sos)/3);

            echo '<div class="noticias" id="checkboxList">';

            foreach ($sos as $so) {
                $verificar = (is_array(old('sos')) && in_array($so->id, old('sos'))) ? 'checked' : '' ;
                $contador++;
                
                if ($contador ===  $sos_por_columna ) {
                    echo '<div class="columna">';
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="sos[]" value="'.$so->id.'" class="item-checkbox" '.$verificar.'><span>'.$so->brand.' '.$so->name.' '.$so->model.'</span></label>';
                    echo '</div>';
                }
                else if ($contador ===  $sos_por_columna ) {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="sos[]" value="'.$so->id.'" class="item-checkbox" '.$verificar.'><span>'.$so->brand.' '.$so->name.' '.$so->model.'</span></label>';
                    echo '</div>';
                    echo '</div>';
                    
                    $contador = 0;
                }
                else {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="sos[]" value="'.$so->id.'" class="item-checkbox" '.$verificar.'><span>'.$so->brand.' '.$so->name.' '.$so->model.'</span></label>';
                    echo '</div>';
                }
            }
            
            echo '</div>';
            @endphp

            <div>
                <p class="font-medium text-sm mb-1">Ofimatica:</p>
            </div>

            @php
            $contador = 0;
            $ofimatics_por_columna = ceil(count($ofimatics)/3);

            echo '<div class="noticias" id="checkboxList">';

            foreach ($ofimatics as $ofimatic) {
                $verificar = (is_array(old('ofimatics')) && in_array($ofimatic->id, old('ofimatics'))) ? 'checked' : '' ;
                $contador++;
                
                if ($contador ===  $ofimatics_por_columna ) {
                    echo '<div class="columna">';
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="ofimatics[]" value="'.$ofimatic->id.'" class="item-checkbox" '.$verificar.'><span>'.$ofimatic->brand.' '.$ofimatic->name.' '.$ofimatic->model.'</span></label>';
                    echo '</div>';
                }
                else if ($contador ===  $ofimatics_por_columna ) {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="ofimatics[]" value="'.$ofimatic->id.'" class="item-checkbox" '.$verificar.'><span>'.$ofimatic->brand.' '.$ofimatic->name.' '.$ofimatic->model.'</span></label>';
                    echo '</div>';
                    echo '</div>';
                    
                    $contador = 0;
                }
                else {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="ofimatics[]" value="'.$ofimatic->id.'" class="item-checkbox" '.$verificar.'><span>'.$ofimatic->brand.' '.$ofimatic->name.' '.$ofimatic->model.'</span></label>';
                    echo '</div>';
                }
            }
            
            echo '</div>';
            @endphp

            <div>
                <p class="font-medium text-sm mb-1">Navegadores:</p>
            </div>

            @php
            $contador = 0;
            $navegators_por_columna = ceil(count($navegators)/3);

            echo '<div class="noticias" id="checkboxList">';

            foreach ($navegators as $navegator) {
                $verificar = (is_array(old('navegators')) && in_array($navegator->id, old('navegators'))) ? 'checked' : '' ;
                $contador++;
                
                if ($contador ===  $navegators_por_columna ) {
                    echo '<div class="columna">';
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="navegators[]" value="'.$navegator->id.'" class="item-checkbox" '.$verificar.'><span>'.$navegator->brand.' '.$navegator->name.' '.$navegator->model.'</span></label>';
                    echo '</div>';
                }
                else if ($contador ===  $navegators_por_columna ) {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="navegators[]" value="'.$navegator->id.'" class="item-checkbox" '.$verificar.'><span>'.$navegator->brand.' '.$navegator->name.' '.$navegator->model.'</span></label>';
                    echo '</div>';
                    echo '</div>';
                    
                    $contador = 0;
                }
                else {
                    echo '<div class="noticia">';
                    echo '<label class="flex items-center space-x-2"><input type="checkbox" name="navegators[]" value="'.$navegator->id.'" class="item-checkbox" '.$verificar.'><span>'.$navegator->brand.' '.$navegator->name.' '.$navegator->model.'</span></label>';
                    echo '</div>';
                }
            }
            
            echo '</div>';
            @endphp

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="flex justify-end mt-4">
                <flux:button variant="primary" type="submit">Crear</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>