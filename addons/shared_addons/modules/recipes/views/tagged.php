<h1>Recipes - {{ tag }}</h1>
{{ if posts }}

{{ posts }}

<Article class="large-12 post">

	<h2><a href="{{ url }}">{{ title }}</a></h2>
	<div class="row">
	<div class="large-3 columns">
		<figure>
			<a href="{{ photo:image }}" class="fancybox"><img src="{{ photo:image }}" alt="{{title}}" class="top"/></a>
			<figcaption>
				Image: {{ image_credit }}
			</figcaption>
		</figure>
	</div>
	<div class="large-9 columns">
		<p>{{ intro }}</p>
		<a href="{{ url }}" class="more">Read more</a>
	</div>
</div>
</article>

{{ /posts }}

{{ else }}

{{ helper:lang line="recipes:currently_no_posts" }}

{{ endif }}
