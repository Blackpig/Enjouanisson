<h1>Recipes - {{ tag }}</h1>
{{ if posts }}

	{{ posts }}

		<div class="post">

			<h3><a href="{{ url }}">{{ title }}</a></h3>

			<div class="meta">

			<div class="date">
				{{ helper:lang line="recipes:posted_label" }}
				<span>{{ helper:date timestamp=created_on }}</span>
			</div>

			{{ if category }}
			<div class="category">
				{{ helper:lang line="recipes:category_label" }}
				<span><a href="{{ url:site }}recipes/category/{{ category:slug }}">{{ category:title }}</a></span>
			</div>
			{{ endif }}

			{{ if keywords }}
			<div class="keywords">
				{{ keywords }}
					<span><a href="{{ url:site }}recipes/tagged/{{ keyword }}">{{ keyword }}</a></span>
				{{ /keywords }}
			</div>
			{{ endif }}

			</div>

			<div class="preview">
			{{ preview }}
			</div>

			<p><a href="{{ url }}">{{ helper:lang line="recipes:read_more_label" }}</a></p>

		</div>

	{{ /posts }}

	{{ pagination }}

{{ else }}
	
	{{ helper:lang line="recipes:currently_no_posts" }}

{{ endif }}
