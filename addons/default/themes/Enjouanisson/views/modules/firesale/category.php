	<h1>{{ category.title }}</h1>
	<p>{{ category.description }}</p>
	{{ if category.children > 0 }}
	<h2>In This Section</h2>
		{{ categories }}
			<div class="row">
				<section class="large-12 columns product_category">
					<div class="row">
		 				<div class="large-4 columns">
		 				{{ if images == null }}
							{{ theme:image file="awaiting_image.png" alt="No Image available" }}
						{{ else }}

							<a href="{{ images.0.path }}" class="fancybox"><img src="{{ images.0.path }}" alt="{{ title }}" class="left"  width="210"/></a>
						{{ endif }}
						</div>
						<div class="large-8 columns">
							<h3><a href="{{ firesale:url route="category" id=id }}">{{ title }}</a></h3>
							<p>{{ description }}</p>
							<a href="{{ firesale:url route="category" id=id }}">&nbsp;</a>
						</div>
					</div>
				</section>
			</div>
		{{ /categories }}
	{{ else }}
		{{ products }}
		<div class="row">
		 	<section class="large-12 columns product_category">
		 		<div class="row">
		 			<div class="large-4 columns">
		 				{{ if image == null }}
							{{ theme:image file="awaiting_image.png" alt="No Image available" }}
						{{ else }}
							<a href="{{ images.0.path }}" class="fancybox"><img src="{{ url:base }}files/thumb/{{ image }}/0/210" alt="{{ title }}" class="left"/></a> 
						{{ endif }}
					</div>
					<div class="large-8 columns">
						<h3>{{ title }}</h3>
						<p>{{ description }}</p>
						<p class="price">{{ price_formatted }} {{ attributes.0.value}}</p>
					</div>
				</div>
			</section>
		</div>
		{{ /products }}
	{{ endif }}