<h1>Recipes</h1>
{{ pages:display slug="recipes" }}
    
    {{ custom_fields }}
        <p>{{ body }} </p>
    {{ /custom_fields }}

{{ /pages:display }}

<h2>Featured Recipe</h2>
{{ if posts }}

	{{ posts }}

		<Article class="post">

			<h2><a href="{{ url }}">{{ title }}</a></h2>

			<div class="large-4 columns">
				<figure>
					<a href="{{ photo:image }}" class="fancybox"><img src="{{ photo:image }}" alt="{{title}}"/></a>
					<figcaption>
					Image: {{ image_credit }}
					</figcaption>
				</figure>
			</div>
			<div class="large-8 columns">
					<p>{{ intro }}</p>
					<a href="{{ url }}" class="more">Read more</a>
			</div>

			

		</div>
	</article>

	{{ /posts }}

{{ else }}
	
	{{ helper:lang line="recipes:currently_no_posts" }}

{{ endif }}
