@extends('layouts.backend.plantilla')

@section('contenido1')

<!-- ############ PAGE START-->
@if(auth()->user()->role == "ADMIN")
<div class="row-col" style="margin-top: 0px;padding-top: 3%;">
	<div class="col-lg b-r">
		<div class="row no-gutter">
			<div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-ios-grid-view text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600">S/.{{number_format($ingresos,2)}}</h2>
						<p class="text-muted m-b-md">Ingresos</p>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[2,3,2,2,1,3,6,3,2,1], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-document text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600">S/.{{number_format($egresos,2)}}</h2>
						<p class="text-muted m-b-md">Egresos</p>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[1,1,0,2,3,4,2,1,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600">S/.{{number_format($cajachica,2)}}</h2>
						<p class="text-muted m-b-md">Caja chica</p>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-paper-airplane text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600">{{$totalventas}}</h2>
						<p class="text-muted m-b-md">Ventas</p>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[3,3,1,62,4,3,7,3,2,5], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
        </div>
		{{-- <div class="padding">
	        <div class="box">
	        	<div class="box-header b-b">
	        		<h3>Ventas de empleados</h3>
	        	</div>
	        	<div>
	        		<div class="row-col">
	        			<div class="col-sm-4 b-r light lt">
	        				<div class="p-a-md">
				                <span class="pull-right text-success">40%</span>
				                <small>Juan</small>
					            <div class="progress progress-xs m-t-sm white bg">
					              <div class="progress-bar success" data-toggle="tooltip" data-original-title="40%" style="width: 40%"></div>
					            </div>
					            <span class="pull-right text-info">25%</span>
					            <small>Carlos</small>
					            <div class="progress progress-xs m-t-sm white bg">
					              <div class="progress-bar info" data-toggle="tooltip" data-original-title="25%" style="width: 25%"></div>
					            </div>
					            <span class="pull-right text-danger">15%</span>
					            <small>Edu</small>
					            <div class="progress progress-xs m-t-sm white bg">
					              <div class="progress-bar danger" data-toggle="tooltip" data-original-title="15%" style="width: 15%"></div>
					            </div>
					        </div>
	        			</div>
	        		</div>
	        	</div>
	        </div>
			<div class="row">
			    <div class="col-sm-12">
			        <div class="box">
			            <div class="box-header">
			              <span class="label success pull-right">52</span>
			              <h3>Productos más vendidos</h3>
			            </div>
			            <div class="p-b-sm">
				            <ul class="list no-border m-a-0">
				              <li class="list-item">
				                <a href="#" class="list-left">
				                	<span class="w-40 avatar danger">
					                  <span>C</span>
					                  <i class="on b-white bottom"></i>
					                </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#">Producto</a></div>
				                  <small class="text-muted text-ellipsis">Designer, Blogger</small>
				                </div>
				              </li>
				              <li class="list-item">
				                <a href="#" class="list-left">
				                  <span class="w-40 avatar purple">
					                  <span>M</span>
					                  <i class="on b-white bottom"></i>
					              </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#">Producto</a></div>
				                  <small class="text-muted text-ellipsis">Writter, Mag Editor</small>
				                </div>
				              </li>
				              <li class="list-item">
				                <a href="#" class="list-left">
				                  <span class="w-40 avatar info">
					                  <span>J</span>
					                  <i class="off b-white bottom"></i>
					              </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#">Producto</a></div>
				                  <small class="text-muted text-ellipsis">Art director, Movie Cut</small>
				                </div>
				              </li>
				              <li class="list-item">
				                <a href="#" class="list-left">
				                  <span class="w-40 avatar warning">
					                  <span>F</span>
					                  <i class="on b-white bottom"></i>
					              </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#">Producto</a></div>
				                  <small class="text-muted text-ellipsis">Musician, Player</small>
				                </div>
				              </li>
				              <li class="list-item">
				                <a href="#" class="list-left">
				                	<span class="w-40 avatar success">
					                  <span>P</span>
					                  <i class="away b-white bottom"></i>
					                </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#">Producto</a></div>
				                  <small class="text-muted text-ellipsis">Musician, Player</small>
				                </div>
				              </li>
				            </ul>
			            </div>
			        </div>
			    </div>
			</div>
		</div> --}}
	</div>
	{{-- <div class="col-lg w-lg w-auto-md white bg">
		<div>
			<div class="p-a">
				<h6 class="text-muted m-a-0">Útimas ventas</h6>
			</div>
			<div class="list inset">
				<a class="list-item" data-toggle="modal" data-target="#chat" data-dismiss="modal">
		            <span class="list-left">
		            	<span class="avatar">
		            		<i class="on avatar-center no-border"></i>
		                	<img src="images/a1.jpg" class="w-20" alt=".">
		                </span>
		            </span>
		            <span class="list-body text-ellipsis">
		            	Producto
		            </span>
	            </a>
	            <a class="list-item" data-toggle="modal" data-target="#chat" data-dismiss="modal">
		            <span class="list-left">
		            	<span class="avatar">
		            		<i class="on avatar-center no-border"></i>
		                	<img src="images/a2.jpg" class="w-20" alt=".">
		                </span>
		            </span>
		            <span class="list-body text-ellipsis">
		            	Producto
		            </span>
	            </a>
	            <a class="list-item" data-toggle="modal" data-target="#chat" data-dismiss="modal">
		            <span class="list-left">
		            	<span class="avatar">
		            		<i class="on avatar-center no-border"></i>
		                	<img src="images/a3.jpg" class="w-20" alt=".">
		                </span>
		            </span>
		            <span class="list-body text-ellipsis">
		            	Producto
		            </span>
	            </a>
	            <a class="list-item" data-toggle="modal" data-target="#chat" data-dismiss="modal">
		            <span class="list-left">
		            	<span class="avatar">
		            		<i class="away avatar-center no-border"></i>
		                	<img src="images/a4.jpg" class="w-20" alt=".">
		                </span>
		            </span>
		            <span class="list-body text-ellipsis">
		            	Producto
		            </span>
	            </a>
	            <a class="list-item" data-toggle="modal" data-target="#chat" data-dismiss="modal">
		            <span class="list-left">
		            	<span class="avatar">
		            		<i class="off avatar-center no-border"></i>
		                	<img src="images/a5.jpg" class="w-20" alt=".">
		                </span>
		            </span>
		            <span class="list-body text-ellipsis">
		            	Producto
		            </span>
	            </a>
	        </div>
        </div>
	</div> --}}
</div>
@endif

<!-- ############ PAGE END-->

@endsection
