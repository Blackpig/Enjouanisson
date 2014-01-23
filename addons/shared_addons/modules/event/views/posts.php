<h1>Events</h1>
{{ if posts }}

{{ posts }}
<Article class="large-12 post">

	<h2><a href="{{ url }}">{{ title }}</a></h2>
	<dl>
		<dt>What:</dt>
		<dd>{{ preview }}</dd>
		<dt>Where:</dt>
		<dd>{{ location }}</dd>
		<dt>When:</dt>
		<dd>{{ helper:date format="jS F" timestamp=start_date }} at {{ helper:date format="h:i a" timestamp=start_date }}</dd>
		{{ if {helper:date format="Ymdhi" timestamp=start_date}  ==  {helper:date format="Ymdhi" timestamp=end_date} }}
			wibble
		{{ endif }}
	</dl>
</article>

{{ /posts }}

{{ pagination }}

{{ else }}

{{ helper:lang line="event:currently_no_posts" }}

{{ endif }}
