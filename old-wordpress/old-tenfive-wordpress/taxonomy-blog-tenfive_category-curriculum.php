<?php
$post_type = get_current_post_type();

if ($post_type == 'post') {
	$slug          = POST;
	$taxonomy      = 'category';
	$template_slug = 'template-parts/content-' . $slug. '.php';
} else {
	$slug          = $post_type;
	$taxonomy      = $post_type . '_category';
	$template_slug = 'template-parts/content.php';
}

$archive_link = home_url($slug . '/');

if (preg_match('/^blog/', $slug)) {
	$slug = 'blog';
}

$label      = get_post_type_object($post_type)->labels;
$post_name  = $label->name;
$categories = get_the_terms(get_the_ID(), $taxonomy);
?>

<?php get_header(); ?>

<article class="taxonomy-blog-tenfive_category-curriculum">

<div class="block478">
  <div class="block478__content">
    <div class="block478__header">
      <div class="block478__headerHeadline">
        <h2>テンファイブ アカデミー</h2>
      </div>
    </div>
    <div class="block478__body">
      <div class="block478__bodyText">
        <p>金融業でもエンジニアとして働くために必要な知識についての質問が数多く寄せられています。業界未経験のエンジニアでも理解できるよう。金融エンジニアとしての基礎となる研修プログラムをまとめました。このプログラムは、金融業界で必要とされる技術を理解し、金融エンジニアとしてのキャリアをスタートさせるための入門編として役立ちます。</p>
      </div>
    </div>
  </div>
</div>

	
	
	
	
<div class="block479">
  <div class="block479__content">
    <div class="block479__header">
      <div class="block479__headerHeadline">
        <h2>テンファイブアカデミーとは？</h2>
      </div>
    </div>
    <div class="block479__body">
      <div class="block479__bodyCaram">
        <div class="block479__bodyItem">
          <div class="block479__bodyImage">
            <img src="/wp-content/uploads/2024/06/curriculum1.png" alt="">
          </div>
          <div class="block479__bodyHeadline2">
            <h3>論理的思考力</h3>
          </div>
        </div>
        <div class="block479__bodyItem">
          <div class="block479__bodyImage">
            <img src="/wp-content/uploads/2024/06/curriculum2.png" alt="">
          </div>
          <div class="block479__bodyHeadline2">
            <h3>問題解決能力</h3>
          </div>
        </div>
        <div class="block479__bodyItem">
          <div class="block479__bodyImage">
            <img src="/wp-content/uploads/2024/06/curriculum3.png" alt="">
          </div>
          <div class="block479__bodyHeadline2">
            <h3>判断力</h3>
          </div>
        </div>
        <div class="block479__bodyItem">
          <div class="block479__bodyImage">
            <img src="/wp-content/uploads/2024/06/curriculum4.png" alt="">
          </div>
          <div class="block479__bodyHeadline2">
            <h3>金融システム</h3>
          </div>
        </div>
      </div>
      <div class="block479__bodyText">
        <p>金融情報システム開発に支援を開始して20年以上の実績を重ねてきたテンファイブ。これらの開発サービス支援のエンジニアとして実績を積んできた当社のメンバー自身の知見をもとに企画構成した金融システムエンジニア向け研修プログラムが、テンファイブアカデミーです。</p>
        <p>テンファイブのメンバーは入社後も仕事をしながらアカデミーを学び、短期間で金融業界のエンジニアとしての実力を身に着け、金融業界のエンジニアとしてのキャリアをスタートしています。講義型ではなく、与えられた課題に対して自ら考え答えを出していくスタイルで構成されています。技術はもちろん、エンジニアにとって大切なスキルである論理的思考力、判断力、問題解決力を身に着けることができます。また、金融業界で求められるスキルや業界構造を理解する為のコンテンツも拡充し、金融業界システムエンジニアとして働くにあたっての最低限の知識を手にいれることができます。</p>
        <p>このアカデミーはトレーニングであると同時に実際のプロジェクトでも利用される技術情報に特化しており、そのまま金融システムエンジニアとしてのキャリアに繋がります。</p>
      </div>
    </div>
  </div>
</div>	

	
<div class="block480">
  <div class="block480__content">
    <div class="block480__header">
      <div class="block480__headerHeadline">
        <h2>カリキュラム一覧　基礎編</h2>
      </div>
      <div class="block480__headerText">
        <p>テンファイブアカデミーの金融システムエンジニア研修プログラムでは、エンジニアリングの基礎から始まり、Java、VB、SQLの基本技術、設計書の作成方法、専門的な金融システムの知識までを網羅しています。このカリキュラムを通じて、金融業界に特化した技術と理解を深めることができます。
</p>
      </div>
    </div>
    <div class="block480__body">
      <div class="block480__bodyCaram">
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/engineer-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Engineering-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>エンジニア基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/infrastructure-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Infrastructure-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>インフラ基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/linux-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Linux-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Linux基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/aws-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/AWS-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>AWS基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/java-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/JAVA-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Java基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/vb-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/VB-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>VB基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/sql-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/SQL-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>SQL基礎</h3>
          </div>
        </div>
		<div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/python-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/09/python-01.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Python基礎</h3>
          </div>
        </div>
		<div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/ai-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/09/ai-01.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>AI基礎</h3>
          </div>
        </div>
		<div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/website-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/11/icon_websiteB.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Webサイト基礎</h3>
          </div>
        </div>
		<div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/javascript-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/11/js2.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>JavaScript基礎</h3>
          </div>
        </div>
		<div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/github-fundamental/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/11/gh2.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>GitHub基礎</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/design-basic/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Design-Documentation-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>設計書の作り方</h3>
          </div>
        </div>
        <div class="block480__bodyItem">
            <a href="/blog-tenfive/curriculum/financial-industry/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Financial-System-Basics.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>金融システム</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>	
	
	

<div class="block480">
  <div class="block480__content">
    <div class="block480__header">
      <div class="block480__headerHeadline">
        <h2>カリキュラム一覧　応用編</h2>
      </div>
      <div class="block480__headerText">
        <p>
          テンファイブアカデミーの金融システムエンジニア研修プログラムでは、エンジニアリングの応用から始まり、
          Java、VB、SQLの基本技術、設計書の作成方法、専門的な金融システムの知識までを網羅しています。
          このカリキュラムを通じて、金融業界に特化した技術と理解を深めることができます。
        </p>
      </div>
    </div>

    <div class="block480__body">
      <div class="block480__bodyCaram">

        <!-- Linux応用 -->
        <!--<div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/linux-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Linux-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Linux応用</h3>
          </div>
        </div>-->

        <!-- AWS応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/aws-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/AWS-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>AWS応用</h3>
          </div>
        </div>

        <!-- SQL応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/sql-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/SQL-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>SQL応用</h3>
          </div>
        </div>

        <!-- Python応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/python-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/09/python-02.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Python応用</h3>
          </div>
        </div>

        <!-- Webサイト応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/website-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/11/con_websiteA-png.webp" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Webサイト応用</h3>
          </div>
        </div>

        <!-- JavaScript応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/javascript-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/11/js1.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>JavaScript応用</h3>
          </div>
        </div>

        <!-- エンジニア応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/engineer-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Engineering-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>エンジニア応用</h3>
          </div>
        </div>

        <!-- インフラ応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/infrastructure-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Infrastructure-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>インフラ応用</h3>
          </div>
        </div>

        <!-- Java応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/java-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/JAVA-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>Java応用</h3>
          </div>
        </div>

        <!-- VB応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/vb-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/VB-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>VB応用</h3>
          </div>
        </div>

        <!-- AI応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/ai-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/09/ai-02.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>AI応用</h3>
          </div>
        </div>

        <!-- 設計書の作り方応用 -->
        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/design-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Design-Documentation-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>設計書の作り方応用</h3>
          </div>
        </div>

        <div class="block480__bodyItem">
          <a href="/blog-tenfive/curriculum/financial-industry-application/"></a>
          <div class="block480__bodyImage">
            <img src="/wp-content/uploads/2024/07/Financial-System-Application.png" alt="">
          </div>
          <div class="block480__bodyHeadline2">
            <h3>金融システム応用</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      

<div class="block478">
  <div class="block478__content">
    <div class="block478__header">
      <div class="block478__headerHeadline">
        <h2>あなたも、テンファイブで<br>金融システムエンジニア技術を習得して一緒に働いてみませんか？</h2>
      </div>
    </div>
    <div class="block478__body">
      <div class="block478__bodyText">
        <p>テンファイブでは、一緒に働いてくれる金融システムエンジニアを募集しています。<br>充実した金融業界特化の技術研修でスキルアップを図り、あなたのエンジニアとしてのキャリア目標を一緒に達成していきませんか？</p>
      </div>
    </div>
    <div class="block478__footer">
      <div class="block478__footerButton">
        <a href="/recruit/">採用情報</a>
      </div>
    </div>
  </div>
</div>	
</article>

<?php get_footer(); ?>
