<html>
	<head>
		<title>Spartz Code Challenge - REST API</title>
		<style>
			html, body { padding: 0px; margin: 0px; }
			.container { padding: 10px; }
			.title { border: 1px solid #aaa; padding: 10px; text-align: center; background-color: #ddd;}
			.collection { margin-top: 10px; border: 1px solid #aaa; padding: 10px; background-color: #eee;}
			.collection .header { font-weight: bold; }
			.methods { border: 1px solid #aaa; background-color: #eee; margin-top: 10px;}
			.method { display: table-row-group;}
			.method .cell { display: table-cell; padding: 10px;}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">Spartz Code Challenge REST API</div>
				<div class="collection">
					<div>
						<span class="header">Collection:</span>
						<span class="resource">states</span>
					</div>
					<div>
						<span class="header">URI:</span>
						<span class="uri">http://localhost/v1/states</span>
					</div>
					<div class="methods">
						<div class="method">
							<span class="header cell">Method</span>
							<span class="header cell">URI</span>
							<span class="header cell">Description</span>
						</div>
						<div class="method">
							<span class="cell">GET</span>
							<span class="cell">http://localhost/v1/states</span>
							<span class="cell">List all available States. (Data supplied by Spartz within cities.csv may be incomplete or malformed)</span>
						</div>
						<div class="method">
							<span class="cell">GET</span>
							<span class="cell">http://localhost/v1/states/<i>state</i>/cities</span>
							<span class="cell">List all available Cities within a given State identified by <i>state</i>. (Data supplied by Spartz within cities.csv may be incomplete or malformed)</span>
						</div>
						<div class="method">
							<span class="cell">GET</span>
							<span class="cell">http://localhost/v1/states/<i>state</i>/cities/<i>city</i>?radius=<i>integer</i></span>
							<span class="cell">List all available Cities within a statute mile radius of <i>city</i> identified by <i>integer</i>. Distance is calculated using the Haversine Formula. Due to the inconsistent curvature of the earth's surface, calculations cannot be guaranteed to be more accurate than 0.5%</span>
						</div>
					</div>
				</div>
				<div class="collection">
					<div>
						<span class="header">Collection:</span>
						<span class="resource">users</span>
					</div>
					<div>
						<span class="header">URI:</span>
						<span class="uri">http://localhost/v1/users</span>
					</div>
					<div class="methods">

						<div class="method">
							<span class="cell">GET</span>
							<span class="cell">http://localhost/v1/users</span>
							<span class="cell">List all available Users. (Data supplied by Spartz within users.csv)</span>
						</div>
						<div class="method">
							<span class="cell">POST</span>
							<span class="cell">http://localhost/v1/users/<i>user</i>/visits</span>
							<span class="cell">Record the visit to one or more Cities by a User identified by <i>user</i>.</br>Expected POST content-type: application/json</br>Example: [{"city":"Mountain View", "state":"CA"}]</br>Note: Due to the fact the the supplied data set is incomplete, Cities or States that are not within the supplied data set will return a message indicating a failure to record warning.</span>
						</div>
						<div class="method">
							<span class="cell">GET</span>
							<span class="cell">http://localhost/v1/users/<i>user</i>/visits</span>
							<span class="cell">List all available Cities that have been visited by a User identified by <i>user</i>.</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
