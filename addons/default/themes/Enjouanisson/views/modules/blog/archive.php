<h1>Articles - {{ month_year }}</h1>

{{ if posts }}

	{{ posts }}

		 <article class="blog large-12">
			<h2>{{ title }}</h2>
			<p>Published on {{ helper:date timestamp=created_on }}</p>
			<p>{{ utilities:truncate text="{{ body }}" type="word" limit="250" }}</p>

			<a href="{{ url }}" class="more">Read more</a>
		</article>

	{{ /posts }}

	{{ pagination }}

{{ else }}
	
	{{ helper:lang line="blog:currently_no_posts" }}

{{ endif }}