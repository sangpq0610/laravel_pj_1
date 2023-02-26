		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1">
						@foreach ($menu as $category)
						@php 
						$flag = false; 
						@endphp
						@if($category->parent_id==null)
						@foreach ($menu as $category_child)
							@if($category->id==$category_child->parent_id)
							@php
								$flag = true;
							@endphp
							@endif
						@endforeach
						
						<li class="dropdown">
							<a href="/category/{{$category->id}}" class="dropdown-toggle">{{$category->name}}@if($flag==true)<span class="caret"></span>@endif</a>
						@if($flag==true)
						<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
							<div class="w3ls_vegetables">
								<ul>
								@foreach ($menu as $category_child)
									@if($category->id==$category_child->parent_id)
									<li><a href="/category/{{$category_child->id}}">{{$category_child->name}}</a></li>
									@endif
								@endforeach
								</ul>
							</div>
						</div>
						@endif
						</li>
						@endif
						@endforeach
					</ul>
				 </div><!-- /.navbar-collapse -->
			</nav>
		</div>