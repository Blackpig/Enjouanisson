	<h1>Products</h1>
	{{ widgets:area slug="products-intro" }}
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