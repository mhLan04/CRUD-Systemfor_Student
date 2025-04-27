<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<?php include 'inc/NavBar.php'; ?>

	<?php include 'inc/Banner.php'; ?>

	<!-- Các phần khác của index.php như service-boxes, scripts... giữ nguyên -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script>
		// Khởi tạo Swiper
		var swiper = new Swiper(".mySwiper-banner", {
			loop: true,
			effect: 'fade',
			speed: 1000,
			fadeEffect: {
				crossFade: true
			},
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			on: {
				slideChangeTransitionStart: function() {
					fadeOutBannerContent();
				},
				slideChangeTransitionEnd: function() {
					updateBannerContent();
				}
			}
		});

		// Fade-out nội dung hiện tại
		function fadeOutBannerContent() {
			const title = document.getElementById('banner-title');
			const subtitle = document.getElementById('banner-subtitle');
			const btn1 = document.getElementById('banner-btn1');
			const btn2 = document.getElementById('banner-btn2');

			// Reset tất cả hiệu ứng ngay lập tức
			title.classList.remove('slide-in', 'fade-in', 'block-fade-in');
			subtitle.classList.remove('slide-in', 'fade-in', 'block-fade-in');
			btn1.classList.remove('slide-in', 'fade-in', 'block-slide-in-left', 'block-slide-in-right');
			btn2.classList.remove('slide-in', 'fade-in', 'block-slide-in-left', 'block-slide-in-right');

			// Ẩn ngay nội dung
			title.classList.add('fade-out');
			subtitle.classList.add('fade-out');

			// Quan trọng: btn1 và btn2 ẩn ngay, không chờ
			btn1.style.opacity = '0';
			btn1.style.transform = 'translateX(-60px)';
			btn2.style.opacity = '0';
			btn2.style.transform = 'translateX(60px)';
		}


		// Update nội dung mới
		function updateBannerContent() {
			const activeSlide = document.querySelector('.swiper-slide-active');

			const titleText = activeSlide.getAttribute('data-title');
			const subtitleText = activeSlide.getAttribute('data-subtitle');
			const btn1Text = activeSlide.getAttribute('data-btn1');
			const btn2Text = activeSlide.getAttribute('data-btn2');
			const btn1Link = activeSlide.getAttribute('data-btn1-link');
			const btn2Link = activeSlide.getAttribute('data-btn2-link');

			const titleEl = document.getElementById('banner-title');
			const subtitleEl = document.getElementById('banner-subtitle');
			const btn1El = document.getElementById('banner-btn1');
			const btn2El = document.getElementById('banner-btn2');

			// Update nội dung
			titleEl.innerHTML = splitTextToSpans(titleText);
			subtitleEl.innerHTML = splitTextToSpans(subtitleText);
			btn1El.textContent = btn1Text;
			btn2El.textContent = btn2Text;

			btn1El.href = btn1Link;
			btn2El.href = btn2Link;

			// Reset animation class
			titleEl.classList.remove('fade-out');
			subtitleEl.classList.remove('fade-out');
			btn1El.classList.remove('fade-out', 'block-fade-in', 'block-fade-in-delay', 'block-slide-in-left', 'block-slide-in-right');
			btn2El.classList.remove('fade-out', 'block-fade-in', 'block-fade-in-delay', 'block-slide-in-left', 'block-slide-in-right');

			// *** Kích lại DOM để đảm bảo animation chạy lại ***
			void btn1El.offsetWidth;
			void btn2El.offsetWidth;

			titleEl.classList.add('fade-in');
			subtitleEl.classList.add('fade-in');

			// Nút vàng slide-in từ trái
			btn1El.classList.add('block-slide-in-left');

			// Nút trắng slide-in từ phải
			btn2El.classList.add('block-slide-in-right');

			// Animate từng ký tự
			animateChars();
		}




		// Hàm tách text thành từng ký tự span
		function splitTextToSpans(text) {
			let html = "";
			for (let i = 0; i < text.length; i++) {
				if (text[i] === " ") {
					html += `<span class="char">&nbsp;</span>`;
				} else {
					html += `<span class="char">${text[i]}</span>`;
				}
			}
			return html;
		}

		// Animate từng ký tự
		function animateChars() {
			const chars = document.querySelectorAll('.char');
			chars.forEach((char, index) => {
				char.style.animation = `charFlyIn 0.6s forwards`;
				char.style.animationDelay = `${index * 0.03}s`;
			});
		}

		document.addEventListener('DOMContentLoaded', function() {
			updateBannerContent(); // Đồng bộ nội dung Slide 1 ngay khi load
		});
	</script>

</body>

</html>