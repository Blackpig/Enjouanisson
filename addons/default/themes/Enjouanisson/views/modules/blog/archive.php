<h1>Articles - {{ month_year }}</h1>

{{ if posts }}

	{{ posts }}

<Article class="large-12 post">

	<h2><a href="{{ url }}">{{ title }}</a></h2>
	<p>Published on {{ helper:date timestamp=created_on }}</p>
	<div class="row">
	{{ if {image} == "" }}
		<div class="large-12 columns">
			<p>{{ preview }}</p>
		<a href="{{ url }}" class="more">Read more</a>
		</div>

	{{ else }}
		<div class="large-3 columns">
			<figure>
				<a href="{{ image:image }}" class="fancybox"><img src="{{ image:thumb }}/0/200" alt="{{title}}" class="top"/></a>
				<figcaption>
					Image: {{ image_credit }}
				</figcaption>
			</figure>
		</div>
		<div class="large-9 columns">
			<p>{{ preview }}</p>
			<a href="{{ url }}" class="more">Read more</a>
		</div>
	{{ endif }}
	</div>
</article>

	{{ /posts }}

	{{ pagination }}

{{ else }}
	
	<p>{{ helper:lang line="blog:currently_no_posts" }}</p>

{{ endif }}