<?php
get_header();
?>

<style>
.grecaptcha-badge {
    display: none !important;
}
</style>

<section id="first-view" class="bg-cover"  >
	<div class="container">
    	<div class="row">
      		<div class="text-content fade-up animation">
        		<h1>未来を変える力を繋げ</h1>
        		<p>一人一人の個性を引き出し、最高のチームを作る</p>
      		</div>
      		<div class="image-content">
        		<img src="<?php echo get_template_directory_uri(); ?>/img/recruit/team-image.png" class="image fade-up animation" alt="チームの画像">
      		</div>
    	</div>
  	</div>
</section>
<!-- Culture -->
<!-- <section id="ambassador" class="bg-cover">
    <div class="container">
      <h2 class="section-heading">Ambassador</h2>
      <h3 class="section-subheading">公式アンバサダー</h3>
      <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/ambassador.jpg" class="image fade-up animation" alt="アンバサダー" />
      <div class="culture-content">
        <div class="culture-text">
          <p>この度、プロサッカー選手として国内外で大活躍の香川真司選手と柴崎岳選手がテンファイブ株式会社の公式アンバサダーとして就任していただきました。<br>
          海を渡り海外のリーグで大活躍する香川選手と柴崎選手のように、テンファイブ株式会社も「ITで人と世界をつなぐ」という理念に邁進しテクノロジーの水平線に向かいたゆまぬ努力を続けていきたいと考えています。</p>
        </div>
       </div>
    </div>
  </section> -->
<!-- Culture -->
<section id="culture" class="bg-cover" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/recruit/culture-bg.jpg');">
    <div class="container">
      <h2 class="section-heading">Culture</h2>
      <h3 class="section-subheading">十人十色、ITで人と世界をつなぐ</h3>
      <div class="culture-content">
        <div class="culture-text">
          <p>英語では十人十色をSo many men,So many mind.と表現されます。<br>
            洋の東西問わず有史以来、人類は多様な人々が多様な価値観を共創、共有して現在に至ります。<br>
            私たちテンファイブは十人十色という、多様な価値観を大切にしながら同時代を生きる仲間と手を取り合い活動しています。<br>            
            私たちテンファイブは創業以来、十人十色の精神で、システム開発、ビジネス開発の領域で「あったらいいな」の世界の実現に様々なベンダーの方々と手を取り合い実現してきました。<br>            
            テンファイブという社名は米国でCB無線や警察無線に用いられる、テンコードという符牒に由来します。<br>
            10-1からはじまる略号において、10−5（テンファイブ）は中継するを意味し、私たちテンファイブは人と人、人と情報、情報と物、物と人、など、様々な物を中継する、そんな存在でありたいと願っています。<br><br>
            世界にひとりしかいない「私」が、たくさん集まり十人十色な「私たち」になり、そんな私たちはITで人と世界をつないで、より良い世界の構築に貢献していきます。</p>
        </div>
        <div class="culture-image">
          <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/culture-logo.png" class="image fade-up animation" alt="カルチャーロゴ" />
        </div>
      </div>
    </div>
  </section>

  <!-- How to Solve -->
<section id="how-to-solve" class="bg-cover" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/recruit/code-of-conduct-bg.jpg');">
    <div class="container">
      <h2 class="section-heading">How to Solve</h2>
      <h3 class="section-subheading">行動規範</h3>
      <p class="catchphrase">プロフェッショナルの意識を持ち、さまざまなことに探求心をもてる方</p>
      <p>とことんエンジニアリングに携わり、とことんITの可能性を追求したい人を求めています。</p>
      <!-- <img src="ten-five-code.jpg" alt="ルール・規範画像" /> -->
    </div>
  </section>
  

  <section class="home-service" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/recruit/service-bg.jpg');">
    <div class="container">
            <h2 class="section-heading">SERVICE</h2>
            <h3 class="section-subheading">事業内容</h3>
        <p class="section-description">エンジニアが働きやすい活躍できる環境を提供し、お客様の業務を支援するサービスを展開する。経験豊富で幅広いスキルを持ち合わせた選抜された人財を取り揃えており、お客様のご要求に対し、スキルとコスト・パフォーマンスが見合う専門的技術者集団でお客様の業務をご支援します。</p>
        <ul class="home-service-ul">
            <li class="home-service-li">
                <div class="text">
                    <span class="number">01.</span>
                    <h3 class="heading">SES(システムエンジニアリングサービス)支援</h3>
                    <p>システムエンジニアやプログラマーをお客様の指定場所に出向参画させ開発業務を支援します。当社では高まるシステムエンジニアの需要に対し採用後、社内にて独自のカリキュラムと教育を施し、関わる業務にロイヤリティを持ったエンジニアの育成に努めています。お客様良し、出向するエンジニア良し、当社良し。の“三方良し”の構図でご支援します。</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/service01.jpg" class="image animation fade-up" alt="" width="570" height="300">
            </li>
            <li class="home-service-li">
                <div class="text">
                    <span class="number">02.</span>
                    <h3 class="heading">制御系開発支援</h3>
                    <p>当社ではデバイス・制御系システムの開発にリアルタイムOSを採用しています。計測機器や制御装置、ロボット制御など、リアルタイムに（非常に高速に）イベントの処理を行なわなければならないような用途に向いています。このようにリアルタイムOSを用いることで、ウインドウズ上で精度の高い計測を行うシステム提供をご支援します。</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/service02.jpg" class="image animation fade-up" alt="" width="570" height="300">
            </li>
            <li class="home-service-li">
                <div class="text">
                    <span class="number">03.</span>
                    <h3 class="heading">インフラ支援</h3>
                    <p>お客様の使用用途に合わせ、最適なサーバー構築を実現します。サーバー構築には、OSの導入、各種アプリケーションソフトのインストール・設定はもちろん、ドメイン環境の構築、ファイヤーウォールの導入等、万全のセキュリティー対策とともにお客様へご提供しています。また、ご自身でのサーバー構築が難しい場合には、弊社にてホスティングサービスを準備しご支援します。</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/service03.jpg" class="image animation fade-up" alt="" width="570" height="300">
            </li>
            <li class="home-service-li">
                <div class="text">
                    <span class="number">04.</span>
                    <h3 class="heading">ウェブ系開発支援</h3>
                    <p>お客様に関するさまざまな情報を基に、ビジネスやITのあるべき姿をシステムとして作り上げていきます。エンジニアリングで培った分析力を基にお客様のニーズを的確に把握し、工数・コストの削減に大きく御協力させていただきます。後工程にも責任を持ち、お客様と深いリレーションシップを構築しより良い商品を提供､ご支援します。</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/service04.jpg" class="image animation fade-up" alt="" width="570" height="300">
            </li>
            <li class="home-service-li">
                <div class="text">
                    <span class="number">05.</span>
                    <h3 class="heading">モバイルアプリ開発支援</h3>
                    <p>スマートフォン、タブレットの需要は今後も増大します。実績豊富なエンジニアにてスマフォアプリに特化してiOS、AndroidOS双方に向けアプリ開発を実施しています。またお客様オリジナルのアプリ開発もご支援します。</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/service05.jpg" class="image animation fade-up" alt="" width="570" height="300">
            </li>
            <li class="home-service-li">
                <div class="text">
                    <span class="number">06.</span>
                    <h3 class="heading">オーダーメード（スクラッチ）開発支援</h3>
                    <p>要件定義から各種テスト工程策定と実施など､プロジェクトの進行管理をすべて行いお客様のシステム開発を行います。開発要件のクライテリア（判断基準）を適正にするために、予算やリリーススケジュール、持続可能な仕組みを見越してのフィージビリティスタディ（実現可能性調査）がとても重要で、それらに対し卓越したプロジェクトマネージャーがご支援します。</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/service06.jpg" class="image animation fade-up" alt="" width="570" height="300">
            </li>
        </ul>
    </div>
</section>



<!-- WorkStyle -->
<section id="workstyle" class="bg-cover" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/recruit/workstyle-bg.jpg');">
    <div class="container">
      <h2 class="section-heading">WorkStyle</h2>
      <h3 class="section-subheading">働く環境</h3>
      <p></p>

      <div class="fullwidth-wrapper">
        <div class="swiper-container workstyle-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/workstyle01.jpg" alt="WorkStyle Image 1" />
            </div>
            <div class="swiper-slide">
              <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/workstyle02.jpg" alt="WorkStyle Image 2" />
            </div>
            <div class="swiper-slide">
              <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/workstyle03.jpg" alt="WorkStyle Image 3" />
            </div>
            <div class="swiper-slide">
              <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/workstyle04.jpg" alt="WorkStyle Image 4" />
            </div>
          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination"></div>
        </div>
      </div>
      <h4 class="section-subheading">福利厚生</h4>
        <div class="welfare">
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei01.png" alt="Icon 1">
            <p>社会保険完備</p>
            </div>
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei02.png" alt="Icon 2">
            <p>賞与年2回<br>※業績連動</p>
            </div>
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei01.png" alt="Icon 1">
            <p>資格手当補助</p>
            </div>
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei02.png" alt="Icon 2">
            <p>資格取得補助</p>
            </div>
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei01.png" alt="Icon 1">
                <p>職能に応じた<br>手当、インセンティブ有り</p>
            </div>
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei02.png" alt="Icon 2">
                <p>401k導入済み</p>
            </div>
            <div class="welfare-item">
                <img src="<?php echo get_template_directory_uri(); ?>/img/recruit/icon-fukurikousei01.png" alt="Icon 1">
            <p>社内イベント年6回<br>（花見、BBQ、スポーツ大会など）</p>
            </div>
        <!-- 以下、同様に続けます -->
        </div>
  </section>
  
<!-- Entry -->
<section id="entry" class="bg-cover">
  <div class="container">
    <h2 class="section-heading">ENTRY</h2>
    <h3  class="section-subheading">エントリー</h3>
    <p>こちらから専用ページをご覧ください。</p>
    <div class="entry-buttons">
      <a href="/new-grad" class="entry-button entry-button-new-grad">新卒の方はこちら</a>
      <a href="/mid-career" class="entry-button entry-button-mid-career">中途採用の方はこちら</a>
    </div>
  </div>
  </section>
<!-- Access -->
<section id="access" class="bg-cover">
  <div class="container">
    <h2  class="section-heading">Access</h2>
    <h3  class="section-subheading">アクセス</h3>
    <div class="address">
      <p>テンファイブ株式会社 本社所在地</p>
      <p>東京都渋谷区神宮前2-13-9　BIRTH神宮前2F(202)</p>
    </div>
    <div class="map">
      <!-- Google Maps Embed -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d810.2751505316892!2d139.71069347554513!3d35.6745247938696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c97e749924f%3A0x27dfa8630d7b0805!2s2f%2C%202-ch%C5%8Dme-13-9%20Jing%C5%ABmae%2C%20Shibuya%20City%2C%20Tokyo%20150-0001!5e0!3m2!1sen!2sjp!4v1698028812125!5m2!1sen!2sjp" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 30,
        loop: true,
        autoplay: {
          delay: 0,
          disableOnInteraction: false,
        },
        speed: 6000,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });

</script>

<?php
get_footer('recruit');
?>
