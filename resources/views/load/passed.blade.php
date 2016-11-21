@extends('layouts.app')

@section('content')
    <h1>Нагрузка</h1>

    <ul class="nav nav-tabs">
        <li><a href="{{ route('load.planned') }}">Запланированная</a></li>
        <li class="active"><a href="{{ route('load.passed') }}">Выполненная</a></li>
    </ul>

    <div class="tab-content">
        <div id="passed" class="tab-pane fade in active">
            <h3>Выполненая нагрузка</h3>
            <div class='row'>
            	<div class='col-md-12'>
		            <form action="" method="get">
		                <div class="form-group col-md-3">
		                    <label>Дата от</label>
		                    <input type="text" name="date_from" value="{{ $dateFrom }}" class="form-control">
		                </div>
		                <div class="form-group col-md-3">
		                    <label>Дата до</label>
		                    <input type="text" name="date_to" value="{{ $dateTo }}" class="form-control">
		                </div>
		                <div class="form-group col-md-3">
		                    <label>Тип отображения</label>
		                    <select class='form-control' name='tableType'>
		                    	<option value='1' {{ $tableType == 1 ? 'selected' : '' }}>Детализированный</option>
		                    	<option value='2' {{ $tableType == 2 ? 'selected' : '' }}>Группированный по месяцам</option>
		                    	<option value='3' {{ $tableType == 3 ? 'selected' : '' }}>Обобщенный по дням</option>
		                    </select>
		                </div>
		                <div class="col-md-3" style="margin-top: 25px;">
		                    <input type="submit" class="btn btn-success" value="Найти">
		                </div>
		            </form>
	            </div>
            </div>

            <hr>

          	<form action='' method='post'>
	            <div class='row'>
		            <div class='col-md-6'>
		            	<div class='form-group'>
			            	<label>Вч. звання</label>
			            	<input type='text' class='form-control' name='uch_zvan'>
		            	</div>
		            	<div class='form-group'>
		            		<label>Посада</label>
		            		<input type='text' class='form-control' name='dolz'>
	            		</div>
		        	</div>
		        	<div class='col-md-6'>
		            	<div class='form-group'>
			            	<label>Вч. ступінь</label>
			            	<input type='text' class='form-control' name='vch_stup'>
		            	</div>
		            	<div class='form-group'>
		            		<label>Прізвище, ініціали</label>
		            		<input type='text' class='form-control' name='name' value='{{ Auth::user()->last_name . ' ' .Auth::user()->first_name }}'>
	            		</div>
		        	</div>
	        	</div>

            @if ($tableType == 3)
            <style>

            .table-bordered thead td {
				height: 200px;
				}

				.table-bordered span {
				transform-origin: 0 50%;
				transform: rotate(-90deg);
				white-space: nowrap;
				display: block;
				position: absolute;
				bottom: 0;
				left: 50%;
				}</style>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    	<td></td>
                        @foreach ($lessonTypes as $type)
                        <td style='position: relative;'><span>{{ $type->name }}</span></td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                	@foreach ($data as $row)
                    <tr>
                        <th colspan="{{ count($lessonTypes) + 1 }}">{{ $row['type'] ? 'Числитель' : 'Знаменатель' }}</th>
                    </tr>
	                    @foreach ($row['data'] as $date => $item)
	                    <tr>
	                    	<td>{{ $date }}</td>
	                    	@foreach ($lessonTypes as $type)
	                    	<td>
	                    	 	@if (isset($item[$type->id]))
	                    	 		{{ $item[$type->id] }}
	                    	 	@else
	                    	 		0
	                    	 	@endif
	                    	</td>
	                    	@endforeach
	                    </tr>
	                    @endforeach
                    @endforeach
                </tbody>
            </table>
            @endif

            @if ($tableType == 1)
	            <table class="table table-bordered">
	                <thead>
	                    <tr>
	                        <td>Дата</td>
	                        <td>Вид заняття</td>
	                        <td>Шифр групи</td>
	                        <td>Кількість годин</td>
	                        <td>Тема заняття</td>
	                        <td>Підпис</td>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach ($data as $row)
	                    <tr>
	                        <td>{{ $row['date'] }}</td>
	                        <td>{{ $row['lesson_type'] }}</td>
	                        <td>{{ $row['group_name'] }}</td>
	                        <td>{{ $row['hours_num'] }}</td>
	                        <td>{{ $row['discipline'] }}</td>
	                        <td></td>
	                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
            @endif

            @if ($tableType == 2)
				<style>

				.table-bordered thead td {
				height: 200px;
				}

				.table-bordered span {
				transform-origin: 0 50%;
				transform: rotate(-90deg);
				white-space: nowrap;
				display: block;
				position: absolute;
				bottom: 0;
				left: 50%;
				}
				</style>
	            <table class="table table-bordered">
	                <thead>
	                    <tr>
	                        <td></td>
	                        <td class='text-center' style='vertical-align: bottom'>Название месяца</td>
	                        @foreach ($lessonTypes as $type)
	                        <td style='position: relative;'><span>{{ $type->name }}</span></td>
	                        @endforeach
	                    </tr>
	                </thead>
	                <tbody class='text-center'>
	                	<tr>
	                		@for ($i = 1; $i <= count($lessonTypes) + 2; $i++)
	                		<td>{{ $i }}</td>
	                		@endfor
	                	</tr>

	                	@foreach ($data as $groupTitle => $group)

	                    @foreach ($group['months'] as $row)
	                    <tr>
	                        <td></td>
	                        <td class='text-left'>{{ $row['month'] }}</td>
	                        @foreach ($lessonTypes as $type)
	                        <td class='text-right'>{{ @$row['data'][$type->id] ?: 0 }}</td>
	                        @endforeach
	                    </tr>
	                    @endforeach

	                    <tr>
	                    	<td></td>
	                    	<td>{{ $groupTitle }}</td>
	                    	@foreach ($lessonTypes as $type)
	                    	<td class='text-right'>{{ @$group['data'][$type->id] ?: 0 }}</td>
	                    	@endforeach
                    	</tr>
	                    @endforeach
	                </tbody>
	            </table>
            </form>
            @endif

            <div class='row'>
            	<div class='col-md-12'>
            		<input type='submit' class='btn btn-success' value='Экспортировать в PDF'>
        		</button>
    		</div>
        </div>
    </div>
@endsection