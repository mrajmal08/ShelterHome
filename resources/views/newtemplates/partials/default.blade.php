@include('newtemplates.partials.head')
@include('newtemplates.partials.header')
<body data-sidebar="dark">
	<div id="layout-wrapper">
		@include('newtemplates.partials.sidebar')
		<div class="main-content">
			<div class="page-content">
				@yield('content')
			</div>
		</div>
	</div>

	@include('newtemplates.partials.footer')
	@yield('jsOutside')

</body>
</html>
