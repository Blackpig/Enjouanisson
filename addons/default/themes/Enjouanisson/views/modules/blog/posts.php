<h1>Articles</h1>
{{ if posts }}
	{{ blog:posts limit="1"}}
		<article class="blog large-12">
			<h2>{{ title }}</h2>
			<p class="meta">Published on {{ helper:date timestamp=created_on }} </p>
			<figure>
				{{ image:img }}
				<figcaption>
					Image: {{ image_credit }}
				</figcaption>
			</figure>

			<p>{{ body }}</p>
			<a href="{{ url }}" class="more">Read more</a>
		</article>
			
	{{ /blog:posts }}

	{{ blog:posts limit="4" offset="1"}}
		
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
				<a href="{{ image:image }}" class="fancybox"><img src="{{ image:image }}/0/200" alt="{{title}}" class="top"/></a>
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
	{{ /blog:posts }}

	
{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}