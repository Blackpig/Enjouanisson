<h1>Articles</h1>
{{ if posts }}
	{{ blog:posts limit="1"}}
		<article class="blog large-12">
			<h2>{{ title }}{{ id }}</h2>
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
		<article class="blog large-12">
			<h2>{{ title }}</h2>
			<p>Published on {{ helper:date timestamp=created_on }}</p>
			
			<p>{{ utilities:truncate text="{{ body }}" type="word" limit="250" }}</p>
			<a href="{{ url }}" class="more">Read more</a>
		</article>
	{{ /blog:posts }}

	
{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}