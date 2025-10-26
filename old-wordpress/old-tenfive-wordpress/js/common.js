document.addEventListener('touchstart', function() {}, {passive: true});

(function($) {
	const header     = $('header');
	const breakpoint = 768;

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
ローダー
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	$(window).on('load', function() {
		load();
	});

	setTimeout(function() {
		load();
	}, 5000);

	function load() {
		if (!$('body').hasClass('load')) {
			setHeight();
			changeHeader();
			$('.loader').css({'visibility': 'hidden', 'opacity': 0});

			setTimeout(function() {
				$('body').addClass('load');
			}, 300);
		}
	}

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
アニメーション animation
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	const animation = $('.animation');
	animation.removeClass('animation');

	if (navigator.userAgent.indexOf('Android') > 0) {
		animation.css({'will-change': 'transform'});
	};

	$(window).on('load resize scroll', function() {
		animation.each(function() {
			const target = $(this).offset().top - window.innerHeight;

			if ($(window).scrollTop() > target) {
				$(this).addClass('animation');
			} else {
				$(this).removeClass('animation');
			}
		});
	});

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
タイピング
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	$('.typing').each(function(index, element) {
		const speed = 0.1;
		let i = 1;

		$(element).contents().each(function () {
			this.parentNode.removeChild(this);

			if (this.nodeType == Node.TEXT_NODE) {
				this.textContent.split('').forEach(function(value) {
					$(element).append('<span class="char-container"><span class="char" style="animation-delay: ' + speed * i + 's;">' + value + '</span></span>');
					i++
				});

			} else {
				$(element).append(this);
			}
		});
	});

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
高さ
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	$(window).on('resize', function() {
		setHeight();
	});

	function setHeight() {
		let height = window.innerHeight - $('header').outerHeight() - $('footer').outerHeight();

		if (height < 0) {
			height = 0;
		}

		$('main').css({'min-height': height});
		$('.home-header').css({'min-height': $(window).height()});
	}

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
ヘッダー
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	$(window).on('resize scroll', function() {
		changeHeader();
	});

	function changeHeader() {
		if ($(window).scrollTop() > 200) {
			header.addClass('change');
		} else {
			header.removeClass('change');
		}
	}

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
ナビゲーション
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	$('#header-toggle, #header-overlay').on('click', function() {
		header.toggleClass('open');

		if (header.hasClass('open')) {
			$('.header-nav').css({'transition': '0.3s ease-out'}).scrollTop(0);
			$('#header-overlay').fadeIn();

		} else {
			$('#header-overlay').fadeOut();
		}
	});

	$(window).on('resize', function() {
		if (window.innerWidth >= breakpoint) {
			$('.header-nav').removeAttr('style');

			if (header.hasClass('open')) {
				header.removeClass('open');
				$('#header-overlay').hide();
			}
		}
	});

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
アンカーリンク
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
	

	$(window).on('load', function() {
		const href = $(location).attr('href');

		if (href.indexOf("#") != -1) {
			let hash = href.split('#')[1];

			if (!hash) {
				return false;
			}

			hash = '#' + hash;

			if ($(hash).length) {
				const target = $(hash).offset().top - $('.header-inner').outerHeight();
				$('html, body').animate({scrollTop: target}, 600);
			}
		}
	});
})(jQuery);

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
外部リンク
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
window.addEventListener('DOMContentLoaded', function() {
	const external = document.querySelectorAll('a[target=_blank]');

	for(let i = 0; i < external.length; i++) {
		external[i].setAttribute('rel', 'noopener');
	}
});

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
CSS Variables Polyfill for IE11
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
window.MSInputMethodContext && document.documentMode && document.write('<script src="https://cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js"><\/script>');

/*+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+
particles.js
+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+--+*/
if (document.querySelector('.home-article')) {
	const params = {
		"particles": {
			"number": {
				"value": 160,
				"density": {
					"enable": true,
					"value_area": 800
				}
			},
			"color": {
				"value": "#ffffff"
			},
			"shape": {
				"type": "circle",
				"stroke": {
					"width": 0,
					"color": "#000000"
				},
				"polygon": {
					"nb_sides": 5
				},
				"image": {
					"src": "img/github.svg",
					"width": 100,
					"height": 100
				}
			},
			"opacity": {
				"value": 1,
				"random": true,
				"anim": {
					"enable": true,
					"speed": 1,
					"opacity_min": 0,
					"sync": false
				}
			},
			"size": {
				"value": 3,
				"random": true,
				"anim": {
					"enable": false,
					"speed": 4,
					"size_min": 0.3,
					"sync": false
				}
			},
			"line_linked": {
				"enable": false,
				"distance": 150,
				"color": "#ffffff",
				"opacity": 0.4,
				"width": 1
			},
			"move": {
				"enable": true,
				"speed": 1,
				"direction": "none",
				"random": true,
				"straight": false,
				"out_mode": "out",
				"bounce": false,
				"attract": {
					"enable": false,
					"rotateX": 600,
					"rotateY": 600
				}
			}
		},
		"interactivity": {
			"detect_on": "canvas",
			"events": {
				"onhover": {
					"enable": true,
					"mode": "bubble"
				},
				"onclick": {
					"enable": true,
					"mode": "repulse"
				},
				"resize": true
			},
			"modes": {
				"grab": {
					"distance": 400,
					"line_linked": {
						"opacity": 1
					}
				},
				"bubble": {
					"distance": 250,
					"size": 0,
					"duration": 2,
					"opacity": 0,
					"speed": 3
				},
				"repulse": {
					"distance": 400,
					"duration": 0.4
				},
				"push": {
					"particles_nb": 4
				},
				"remove": {
					"particles_nb": 2
				}
			}
		},
		"retina_detect": true
	}

	particlesJS("home-header-particles", params);
}
























//ボタンを押すごとに画面が切り替わる関数
  jQuery(function () {
    $(".btn").on("click", function () {
      //btnクラスをクリック後の関数処理
      $(this).parent().parent().parent().css("display", "none");
      //質問画面にあたらる親要素divをdisplay:none;にする
      id = $(this).attr("href");
      //次の質問hrefをidに格納
      $(id).addClass("fit").fadeIn("slow").show();
      //次の質問にfitをつけて出力。
    });
});


//選択ボタンデータを配列に入れてカウントする関数
      var Q1_y;
      var Q1_n;
      var Q2_y;
      var Q2_n;
      var Q3_y;
      var Q3_n;
      var Q4_y;
      var Q4_n;
      var Q5_y;
      var Q5_n;
      var box =[];
      //それぞれのデータを配列に入れるための変数box
    jQuery(".btn").each(function(){
      $(this).on('click',function(){
        var value = $(this).data("value");
         box.push(value);
         //data-value値をboxに入れる。(配列に値を入れるときはpush()を使用)

        Q1 = box.filter(function(b){
                      return b === "b"
                    }).length;
        Q2 = box.filter(function(d){
                        return d === "d"
                    }).length;
        Q3 = box.filter(function(f){
                        return f === "f"
                    }).length;
        Q4 = box.filter(function(h){
                        return h === "h"
                    }).length;
        Q5 = box.filter(function(j){
                        return j === "j"
                    }).length;
        console.log("Q1" + Q1);
        console.log("Q2" + Q2);
        console.log("Q3" + Q3);
        console.log("Q4" + Q4);
        console.log("Q5" + Q5);
      });
    });




    jQuery('.end').on('click',function(){
      //endクラスをクリックしたときの関数
      if( Q1 == 1 && Q2 == 1 && Q3 == 1 && Q4 == 1 && Q5 == 1 ) {
        window.location.href = 'https://10-5.jp/occupational-diagnosis/web-app/';
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 1 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/infrastructure-engineer/');
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 1 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/embedded-engineer/');
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 1 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/software-engineer/');
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 0 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/in-house-se/');
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 0 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/app-development-engineer/');
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 0 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/system-engineer/');
      } else if( Q1 == 1 && Q2 == 1 && Q3 == 0 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/data-scientist/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 1 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/ai-engineer/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 1 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/project-manager/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 1 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/web-app/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 1 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/app-development-engineer/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 0 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/software-engineer/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 0 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/infrastructure-engineer/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 0 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/embedded-engineer/');
      } else if( Q1 == 1 && Q2 == 0 && Q3 == 0 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/in-house-se/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 1 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/data-scientist/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 1 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/ai-engineer/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 1 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/ai-engineer/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 1 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/data-scientist/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 0 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/project-manager/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 0 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/project-manager/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 0 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/system-engineer/');
      } else if( Q1 == 0 && Q2 == 1 && Q3 == 0 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/system-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 1 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/embedded-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 1 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/embedded-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 1 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/ai-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 1 && Q4 == 0 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/embedded-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 0 && Q4 == 1 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/software-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 0 && Q4 == 1 && Q5 == 0 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/infrastructure-engineer/');
      } else if( Q1 == 0 && Q2 == 0 && Q3 == 0 && Q4 == 0 && Q5 == 1 ) {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/in-house-se/');
      } else {
        $('.btn').attr('href', 'https://10-5.jp/occupational-diagnosis/in-house-se/');
      }
  });

// 共通の機能をIIFEでラップ
(function($) {
    'use strict';

    // ドキュメント準備完了時の処理
    $(document).ready(function() {
        // ローダーの非表示
        $('.loader').fadeOut(600);

        // スムーススクロール
        $('a[href^="#"]').click(function() {
            const speed = 500;
            const href = $(this).attr('href');
            const target = $(href === '#' || href === '' ? 'html' : href);
            const position = target.offset().top;
            $('html, body').animate({scrollTop: position}, speed, 'swing');
            return false;
        });

        // アニメーション要素の処理
        $('.animation').each(function() {
            const $this = $(this);
            const position = $this.offset().top;
            const scroll = $(window).scrollTop();
            const windowHeight = $(window).height();

            if (scroll > position - windowHeight + 100) {
                $this.addClass('active');
            }
        });

        $(window).scroll(function() {
            $('.animation').each(function() {
                const $this = $(this);
                const position = $this.offset().top;
                const scroll = $(window).scrollTop();
                const windowHeight = $(window).height();

                if (scroll > position - windowHeight + 100) {
                    $this.addClass('active');
                }
            });
        });
    });

})(jQuery);

// チャットボット機能
(function($) {
    'use strict';

    $(document).ready(function() {
        // チャットボット要素の取得
        const $container = $('#chatbot-container');
        const $toggle = $('#chatbot-toggle');
        const $chatWindow = $('#chatbot-window');
        const $closeButton = $('.chatbot-close');
        const $messageInput = $('#chatbot-message');
        const $sendButton = $('#chatbot-send');
        const $messagesContainer = $('#chatbot-messages');

        // デバッグ情報
        console.log('Chatbot elements:', {
            container: $container.length,
            toggle: $toggle.length,
            chatWindow: $chatWindow.length,
            closeButton: $closeButton.length,
            messageInput: $messageInput.length,
            sendButton: $sendButton.length,
            messagesContainer: $messagesContainer.length
        });

        // 初期メッセージを表示
        if ($messagesContainer.length) {
            appendMessage('bot', 'こんにちは！テンファイブのAIアシスタントです。ご質問やご相談がございましたら、お気軽にお申し付けください。😊');
        }

        // トグルボタンのクリックイベント
        $(document).on('click', '#chatbot-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Toggle button clicked');
            
            if ($chatWindow.is(':visible')) {
                $chatWindow.fadeOut(200).removeClass('active');
                $('body').css('overflow', '');
            } else {
                $chatWindow.fadeIn(200).addClass('active');
                // モバイルでスクロール固定
                if (window.innerWidth <= 768) {
                    $('body').css('overflow', 'hidden');
                    // 入力欄にフォーカスを当てる
                    setTimeout(function() {
                        $messageInput.focus();
                    }, 300);
                }
            }
        });

        // 閉じるボタンのクリックイベント
        $(document).on('click', '.chatbot-close', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Close button clicked');
            $chatWindow.fadeOut(200).removeClass('active');
            $('body').css('overflow', '');
        });

        // メッセージ入力時の処理
        $messageInput.on('focus', function() {
            // モバイルでキーボードが表示されたときにスクロール
            if (window.innerWidth <= 768) {
                setTimeout(function() {
                    $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);
                }, 300);
            }
        });

        // 画面回転時の処理
        $(window).on('resize orientationchange', function() {
            if ($chatWindow.is(':visible')) {
                $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);
            }
        });

        // チャットウィンドウ内のタッチイベントを親要素に伝播させない
        $chatWindow.on('touchmove', function(e) {
            e.stopPropagation();
        });

        // メッセージ送信関数
        function sendMessage() {
            const message = $messageInput.val().trim();
            if (!message) return;

            // メッセージをチャット画面に追加
            appendMessage('user', message);
            $messageInput.val('');

            // サーバーにメッセージを送信
            $.ajax({
                url: chatbotAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'chatbot_message',
                    nonce: chatbotAjax.nonce,
                    message: message
                },
                success: function(response) {
                    if (response.success) {
                        appendMessage('bot', response.data.message, response.data.links);
                    } else {
                        appendMessage('bot', 'すみません、エラーが発生しました。もう一度お試しください。');
                    }
                },
                error: function() {
                    appendMessage('bot', 'すみません、エラーが発生しました。もう一度お試しください。');
                }
            });
        }

        // メッセージ表示関数
        function appendMessage(type, content, links = null) {
            const $messageDiv = $('<div>').addClass(`chatbot-message ${type}-message`);
            
            // メッセージ本文（URLを自動リンク化）
            let linkedContent = content
                // Markdownスタイルのリンクを処理
                .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank">$1</a>')
                // 通常のURLを処理
                .replace(/(?<![\(\["])(https?:\/\/[^\s\)]+)/g, '<a href="$1" target="_blank">$1</a>')
                // 壊れたリンクを修正
                .replace(/@(https?:\/\/[^\s\)]+)/g, '<a href="$1" target="_blank">$1</a>')
                // 重複したリンクタグを修正
                .replace(/<a href="<a href="([^"]+)"[^>]*>([^<]+)<\/a>"[^>]*>([^<]+)<\/a>/g, '<a href="$1" target="_blank">$2</a>');

            const $messageContent = $('<div>').addClass('message-content').html(linkedContent);
            $messageDiv.append($messageContent);

            // リンクがある場合は追加
            if (links && Array.isArray(links)) {
                const $linksContainer = $('<div>').addClass('message-links');
                links.forEach(link => {
                    const $link = $('<a>')
                        .attr('href', link.url)
                        .attr('target', '_blank')
                        .text(link.text)
                        .addClass('chatbot-link');
                    $linksContainer.append($link);
                });
                $messageDiv.append($linksContainer);
            }

            $messagesContainer.append($messageDiv);
            $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);
        }

        // 送信ボタンのクリックイベント
        $(document).on('click', '#chatbot-send', sendMessage);

        // Enterキーでの送信
        $messageInput.on('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    });
})(jQuery);