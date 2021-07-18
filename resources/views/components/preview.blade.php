@extends('layouts.home_layouts',  ['title' => 'Preview'])
@push('editor_styles')
<link href="{{ asset('assets/vendor/prism/prism.css') }}" rel="stylesheet">
@endpush
@section('container')
<!-- Page Header-->
<header class="masthead" style="background-image: url({{ asset('assets/blog/img/wave-white.svg') }})">
	<div class="container position-relative px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<div class="post-heading">
					<h1>Deret Fibonacci dengan PHP</h1>
					<span class="meta">
						Posted by
						<a href="#!">Start Bootstrap</a>
						on August 24, 2021
					</span>
				</div>
			</div>
		</div>
	</div>
</header>
<article class="mb-4">
	<div class="container px-4 px-lg-5">
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
<p>Hello there! on this occasion.. gw ingin bercerita tentang pengalaman gw saat berkecimpung di dunia bridge. Dari bagaimana awal gw memulai, apa saja tantangan yang gw hadapi, sampai bagaimana akhirnya gw bisa melalui semua till now. The way I tried sooo hard just to be number one, how I realize being the best wasn't that best, and the way Bridge changed me.</p>
<i>	&ldquo;ha?? bridge? jembatan maksudnya??&rdquo;</i>
<p>Iya.. jembatan, tapi bukan jembatan biasa. Lebih tepatnya Mind Sports Contract Bridge.</p>
<i>&ldquo;Contract Bridge itu olahraga apa???&rdquo;</i> 
<p>Contract Bridge adalah salah satu cabang olahraga otak yang mengandalkan kemampuan teknis, kecerdasan, dan juga keberuntungan dengan menggunakan kartu. Bridge juga dapat diartikan sebagai jembatan yang dibentangkan untuk mencapai suatu persetujuan atau kontrak tertentu antara dua individu yang saling berkomunikasi dengan menggunakan sistem yang disebut bidding.</p>
<i>&ldquo;Ohh.. terus cara mainnya???&rdquo;</i>
<p>Permainan Bridge ini dimulai dengan dibagikannya satu set kartu (52) secara acak ke semua pemain, lalu dilakukannya perebutan kontrak oleh kedua pasangan melalui penawaran/bidding. Misi dari pasangan yang memenangkan penawaran/bidding adalah memenuhi kontrak sesuai penawarannya atau bahkan melebihinya, sedangkan pasangan yang lain berusaha agar kontrak tersebut gagal dipenuhi. Kontrak adalah pernyataan oleh salah satu pasangan bahwa pihak mereka akan meng ambil sejumlah (atau lebih) trik. Sedangkan, yang dimaksud dengan trik ini adalah kemenangan pada satu putaran kartu dari empat pemain. Karena jum lah kartu ada 52 dan tiap-tiap pemain memegang 13 kartu, maka terdapat 13 trik dalam satu kali permainan. Adapun penawaran/bidding ini menentukan pihak yang menyatakan, the strain of trump dan lokasi pemimpin untuk kartu di tangan.</p>
<i>&ldquo;Ohh gitu.. hmm.. kayaknya gampang ya??&rdquo;</i>
<p>hehehe iya :')</p>
<p>Oke tanpa bertele-tele lagi atau menjadi dua public figur yang bertanya sekaligus memberi jawaban, let's dive in!</p>
<p>
<img class="img-fluid" src="https://i.postimg.cc/KzzkgJsT/IMG-20181118-223721.jpg" alt="Telkom Indonesia Open 2018">
<span class="caption text-muted">Telkom Indonesia Open 2018</span>
 </p>
<p>In the beginning of time.. (asekk)<br>Gw masih menjadi karyawan disalah satu perusahaan yang bergerak di bidang keuangan. Lalu nyokap bilang katanya ada kesempatan untuk kuliah melalui jalur beasiswa Bridge, iya.. beasiswa.. which is I don't need to pay attention (that much) about.. yeah you know what I mean.</p>
<p>So.. gw akhirnya..</p>
<p class="text-muted">To be continued..</p>
			</div>
		</div>
	</div>
</article>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5eef7ac28f548f31"></script>
<script>
	$(document).ready(function(){
		$(".btn-share").click(function(){
			$("#socialShare").slideToggle();
		});
	});
</script>
@push('editor_scripts')
<script src="{{ asset('assets/vendor/prism/prism.min.js') }}"></script>
@endpush