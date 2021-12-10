<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Table Sorting, Filtering, Etc from JavascriptToolbox.com</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="table.js"></script>
<link rel="stylesheet" type="text/css" href="table.css" media="all">
</head>
<body>

<table class="example table-autosort:0 table-stripeclass:alternate">
<thead>
	<tr>
		<th colspan="5">Rowspan/Colspan Correction</th>
	</tr>
	<tr>
		<th class="table-sortable:numeric" rowspan="2">Index</th>
		<th colspan="2">First Two Columns</th>
		<th colspan="2">Second Two Columns</th>
	</tr>
	<tr>
		<th class="table-sortable:numeric">Numeric</th>
		<th class="table-sortable:default">Text</th>
		<th class="table-sortable:currency">Currency</th>
		<th class="table-sortable:date">Date</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>0</td>
		<td>967.2</td>
		<td>Bill</td>
		<td>$66.555</td>
		<td>2009-08-29</td>
	</tr>
	<tr class="alternate">
		<td>1</td>
		<td>318.2</td>
		<td>Joe</td>
		<td>$41.225</td>
		<td>2011-03-31</td>
	</tr>
	<tr>
		<td>2</td>
		<td>526.7</td>
		<td>Bob</td>
		<td>$68.205</td>
		<td>2009-03-17</td>
	</tr>
	<tr class="alternate">
		<td>3</td>
		<td>279.5</td>
		<td>Matt</td>
		<td>$7.004</td>
		<td>2010-08-02</td>
	</tr>
	<tr>
		<td>4</td>
		<td>768.9</td>
		<td>Mark</td>
		<td>$78.145</td>
		<td>2010-01-10</td>
	</tr>
	<tr class="alternate">
		<td>5</td>
		<td>848.9</td>
		<td>Tom</td>
		<td>$54.565</td>
		<td>2010-12-23</td>
	</tr>
	<tr>
		<td>6</td>
		<td>732.1</td>
		<td>Jake</td>
		<td>$90.925</td>
		<td>2011-06-11</td>
	</tr>
	<tr class="alternate">
		<td>7</td>
		<td>127.5</td>
		<td>Greg</td>
		<td>$27.365</td>
		<td>2008-11-16</td>
	</tr>
	<tr>
		<td>8</td>
		<td>414.5</td>
		<td>Adam</td>
		<td>$59.425</td>
		<td>2009-01-19</td>
	</tr>
	<tr class="alternate">
		<td>9</td>
		<td>976.3</td>
		<td>Steve</td>
		<td>$18.895</td>
		<td>2009-07-25</td>
	</tr>
</tbody>
</table>

<h2>Client-Side Table Filtering</h2>

<p>
Client-side table filtering works by scanning each row in the table and matching it against the criteria passed into the filter. Filter values are stored, so adding or removing another filter maintains any other filters that still apply.
<br>
The filters in this example were created manually, not using the auto-filter functionality. The first filter is a manually-create select list, the second is a text input for entering free-form text, and the third uses custom functions to do the filtering.
</p>

<table class="example table-stripeclass:alternate">
<thead>
	<tr>
		<th colspan="4">Table Filtering</th>
	</tr>
	<tr>
		<th class="filterable">Index</th>
		<th class="filterable">Number</th>
		<th class="filterable">Name</th>
		<th class="filterable">Amount</th>
	</tr>
	<tr>
		<th>Filter:</th>
		<th><select onchange="Table.filter(this,this)"><option value="">All</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></th>
		<th><input name="filter" size="8" onkeyup="Table.filter(this,this)"></th>
		<th><select onchange="Table.filter(this,this)"><option value="function(){return true;}">All</option><option value="function(val){return parseFloat(val.replace(/\$/,''))>1;}">&gt; $1</option><option value="function(val){return parseFloat(val.replace(/\$/,''))<=1;}">&lt;= $1</option></th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>0</td>
		<td>0</td>
		<td>Bill</td>
		<td>$0.43</td>
	</tr>
	<tr class="alternate">
		<td>1</td>
		<td>1</td>
		<td>Joe</td>
		<td>$0.33</td>
	</tr>
	<tr>
		<td>2</td>
		<td>2</td>
		<td>Bob</td>
		<td>$1.93</td>
	</tr>
	<tr class="alternate">
		<td>3</td>
		<td>3</td>
		<td>Matt</td>
		<td>$1.03</td>
	</tr>
	<tr>
		<td>4</td>
		<td>4</td>
		<td>Mark</td>
		<td>$0.93</td>
	</tr>
	<tr class="alternate">
		<td>5</td>
		<td>0</td>
		<td>Tom</td>
		<td>$0.73</td>
	</tr>
	<tr>
		<td>6</td>
		<td>1</td>
		<td>Jake</td>
		<td>$0.73</td>
	</tr>
	<tr class="alternate">
		<td>7</td>
		<td>2</td>
		<td>Greg</td>
		<td>$0.03</td>
	</tr>
	<tr>
		<td>8</td>
		<td>3</td>
		<td>Bill</td>
		<td>$0.13</td>
	</tr>
	<tr class="alternate">
		<td>9</td>
		<td>4</td>
		<td>Joe</td>
		<td>$1.03</td>
	</tr>
	<tr>
		<td>10</td>
		<td>0</td>
		<td>Bob</td>
		<td>$0.63</td>
	</tr>
	<tr class="alternate">
		<td>11</td>
		<td>1</td>
		<td>Matt</td>
		<td>$0.23</td>
	</tr>
	<tr>
		<td>12</td>
		<td>2</td>
		<td>Mark</td>
		<td>$0.23</td>
	</tr>
	<tr class="alternate">
		<td>13</td>
		<td>3</td>
		<td>Tom</td>
		<td>$0.13</td>
	</tr>
	<tr>
		<td>14</td>
		<td>4</td>
		<td>Jake</td>
		<td>$1.83</td>
	</tr>
	<tr class="alternate">
		<td>15</td>
		<td>0</td>
		<td>Greg</td>
		<td>$1.13</td>
	</tr>
	<tr>
		<td>16</td>
		<td>1</td>
		<td>Bill</td>
		<td>$1.83</td>
	</tr>
	<tr class="alternate">
		<td>17</td>
		<td>2</td>
		<td>Joe</td>
		<td>$0.93</td>
	</tr>
	<tr>
		<td>18</td>
		<td>3</td>
		<td>Bob</td>
		<td>$0.63</td>
	</tr>
	<tr class="alternate">
		<td>19</td>
		<td>4</td>
		<td>Matt</td>
		<td>$1.33</td>
	</tr>
	<tr>
		<td>20</td>
		<td>0</td>
		<td>Mark</td>
		<td>$0.73</td>
	</tr>
	<tr class="alternate">
		<td>21</td>
		<td>1</td>
		<td>Tom</td>
		<td>$0.33</td>
	</tr>
	<tr>
		<td>22</td>
		<td>2</td>
		<td>Jake</td>
		<td>$1.53</td>
	</tr>
	<tr class="alternate">
		<td>23</td>
		<td>3</td>
		<td>Greg</td>
		<td>$1.33</td>
	</tr>
	<tr>
		<td>24</td>
		<td>4</td>
		<td>Bill</td>
		<td>$0.53</td>
	</tr>
	<tr class="alternate">
		<td>25</td>
		<td>0</td>
		<td>Joe</td>
		<td>$0.33</td>
	</tr>
	<tr>
		<td>26</td>
		<td>1</td>
		<td>Bob</td>
		<td>$0.53</td>
	</tr>
	<tr class="alternate">
		<td>27</td>
		<td>2</td>
		<td>Matt</td>
		<td>$0.73</td>
	</tr>
	<tr>
		<td>28</td>
		<td>3</td>
		<td>Mark</td>
		<td>$0.33</td>
	</tr>
	<tr class="alternate">
		<td>29</td>
		<td>4</td>
		<td>Tom</td>
		<td>$0.83</td>
	</tr>
	<tr>
		<td>30</td>
		<td>0</td>
		<td>Jake</td>
		<td>$1.33</td>
	</tr>
	<tr class="alternate">
		<td>31</td>
		<td>1</td>
		<td>Greg</td>
		<td>$0.73</td>
	</tr>
	<tr>
		<td>32</td>
		<td>2</td>
		<td>Bill</td>
		<td>$1.13</td>
	</tr>
	<tr class="alternate">
		<td>33</td>
		<td>3</td>
		<td>Joe</td>
		<td>$1.23</td>
	</tr>
	<tr>
		<td>34</td>
		<td>4</td>
		<td>Bob</td>
		<td>$1.73</td>
	</tr>
</tbody>
</table>


</body>
</html>
