{{ post }}
	<article class="blog row">
		<h1>{{ title }}</h1>
		<div class="row ">
			<div class="large-5 columns">
				<figure>
					<a href="{{ featured_image:image }}" class="fancybox"><img src="{{ featured_image:thumb }}/0/250" /></a> 
				</figure>
			</div>
			<div id="event_specs" class="large-7 columns">
				<dl>
					<dt>What:</dt>
					<dd>{{ preview }}</dd>
					<dt>Where:</dt>
					<dd>{{ location }}</dd>
					<dt>When:</dt>
					<dd>{{ helper:date format="jS F" timestamp=start_date }} at {{ helper:date format="h:i a" timestamp=start_date }}</dd>
							{{ if {helper:date format="Ymdhi" timestamp=start_date}  ==  {helper:date format="Ymdhi" timestamp=end_date} }}
						{{ endif }}
				</dl>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<p>{{ body }}</p>
			</div>
		</div>		
	</article>


{{ /post }}