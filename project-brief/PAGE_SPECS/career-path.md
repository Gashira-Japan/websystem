# キャリアパスページ仕様

## 目的
テンファイブでのキャリア形成と成長の道筋を説明

## テンプレート
- **ベース**: `templates/page-template.html`
- **ヒーロー**: `templates/subpage-hero-template.html`
- **コンポーネント**: Section, CareerCard, CTA

## セクション構成

### 1. ヒーローセクション
```html
<section class="hero hero--subpage hero--workstyle">
  <div class="container">
    <div class="hero__content">
      <h1 class="hero__title">キャリアパス</h1>
      <p class="hero__subtitle">Career Path</p>
      <p class="hero__description">テンファイブでの成長の道筋と、あなたの可能性を広げるキャリアプランをご紹介します。</p>
    </div>
    <div class="hero__accent"></div>
  </div>
</section>
```

### 2. キャリアパスセクション
```html
<section class="section" data-section="career-path">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">成長の道筋</h2>
      <p class="section__subtitle">Growth Path</p>
    </div>
    <div class="career-timeline">
      <!-- CareerCard × 4 -->
    </div>
  </div>
</section>
```

### 3. スキルセクション
```html
<section class="section" data-section="skills">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">身につくスキル</h2>
      <p class="section__subtitle">Skills You'll Develop</p>
    </div>
    <div class="cards-grid cards-grid--3">
      <!-- SkillCard × 6 -->
    </div>
  </div>
</section>
```

## コンポーネント仕様

### CareerCard（キャリアカード）
```html
<div class="career-card">
  <div class="career-card__timeline">
    <div class="career-card__year">1年目</div>
  </div>
  <div class="career-card__content">
    <h3 class="career-card__title">ジュニアエンジニア</h3>
    <p class="career-card__description">基礎的な開発スキルを身につける</p>
    <ul class="career-card__skills">
      <li>プログラミング基礎</li>
      <li>チーム開発</li>
    </ul>
  </div>
</div>
```

### SkillCard（スキルカード）
```html
<div class="skill-card">
  <div class="skill-card__icon">
    <svg class="skill-card__icon-svg">...</svg>
  </div>
  <div class="skill-card__content">
    <h3 class="skill-card__title">技術スキル</h3>
    <p class="skill-card__description">最新技術の習得と実践</p>
  </div>
</div>
```

## 文言ソース
- **データソース**: `ascii-md/03_career-path_ascii.md`
- **画像**: `assets/images/career-path-pc.jpg`, `assets/images/career-path-tab.jpg`, `assets/images/career-path-sp.jpg`

## 完了条件

### デザイン
- [ ] デザイントークンのみ使用（直書き禁止）
- [ ] 768px/1024pxで崩れない
- [ ] キャリアタイムラインが適切に表示
- [ ] スキルカードが3列グリッドで表示

### アクセシビリティ
- [ ] Lighthouse (Accessibility) 90+ 目安
- [ ] alt属性が適切に設定
- [ ] 見出し階層が正しい
- [ ] キーボードナビゲーション対応

### パフォーマンス
- [ ] 画像はwebp優先
- [ ] 必要なら2x対応
- [ ] 読み込み速度最適化

### コード品質
- [ ] 既存コンポーネントを再利用
- [ ] 独自CSSは`components/_local-career-path.scss`に限定
- [ ] セマンティックHTML使用
- [ ] 適切なaria属性設定
