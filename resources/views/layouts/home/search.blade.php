<form class="d-flex" action="{{ route('search.posts') }}" method="GET">
	<input class="form-control me-2 rounded" name="keywords" type="search" placeholder="Keywords.." aria-label="Search" autocomplete="off">
	<button class="btn btn-outline-dark btn-sm rounded" type="submit">Search</button>
</form>