# CSSファイル管理ルール

## 基本方針
**個別ファイルの量産を禁止し、適切な統合管理を行う**

## ファイル構成ルール

### 1. トップページ用
- `design-system.css` - デザインシステムの基本設定
- `sections.css` - セクション共通スタイル
- `components.css` - コンポーネント共通スタイル

### 2. 下層ページ共通
- `subpage-hero.css` - 下層ページのヒーローセクション
- `sections.css` - セクション共通スタイル（トップページと共有）
- `components.css` - コンポーネント共通スタイル（トップページと共有）

### 3. LP（ランディングページ）用
- 必要に応じて個別ファイルを作成
- ただし、共通スタイルは既存ファイルを活用

### 4. 個別ページ用
- **禁止**: セクションごとの個別CSSファイル作成
- **推奨**: 既存の共通ファイルに追加
- **例**: `numbers.css`（数字で見るページ専用）は許可

## 禁止事項

### ❌ 禁止パターン
```
css/
├── section-description.css  ← 禁止
├── section-hero.css        ← 禁止
├── section-company.css      ← 禁止
├── section-career.css      ← 禁止
└── section-workstyle.css   ← 禁止
```

### ❌ セクション個別のpadding/margin定義禁止
```css
/* 禁止: セクション個別のpadding定義 */
.ai-capabilities {
  padding: var(--spacing-16) 0;  /* ❌ 禁止 */
}

.basic-requirements {
  margin: var(--spacing-8) 0;    /* ❌ 禁止 */
}

/* 禁止: セクション個別の上下マージン定義 */
.company-values {
  margin-top: var(--spacing-12); /* ❌ 禁止 */
  margin-bottom: var(--spacing-8); /* ❌ 禁止 */
}
```

### ✅ 許可される個別設定
```css
/* 許可: 背景色での調整 */
.ai-capabilities {
  background: var(--color-primary-50);  /* ✅ 許可 */
}

.basic-requirements {
  background: var(--color-neutral-50);   /* ✅ 許可 */
}

/* 許可: カード内padding */
.capability-card {
  padding: var(--spacing-8);            /* ✅ 許可 */
}

/* 許可: リスト内padding */
.capability-card__list li {
  padding: var(--spacing-3) 0;          /* ✅ 許可 */
}
```

### ✅ 推奨パターン
```
css/
├── design-system.css       ← デザインシステム
├── sections.css           ← セクション共通
├── components.css         ← コンポーネント共通
├── subpage-hero.css       ← 下層ページヒーロー
├── numbers.css            ← 個別ページ専用（例）
└── shared-*.css           ← 共有ファイル
```

## 統合ルール

### 1. セクション関連
- すべてのセクションスタイルは `sections.css` に統合
- 個別のセクションCSSファイルは作成禁止

### 2. コンポーネント関連
- 共通コンポーネントは `components.css` に統合
- 個別のコンポーネントCSSファイルは作成禁止

### 3. ページ専用スタイル
- 特定のページでしか使用しないスタイルのみ個別ファイル許可
- 例: `numbers.css`（数字で見るページの円グラフなど）

## セクション個別スタイルのルール

### 1. セクション個別セレクターの許可
```css
/* 許可: セクション個別のセレクター */
.ai-capabilities { }
.basic-requirements { }
.company-values { }
.era-transition { }
```

### 2. 禁止される個別設定
```css
/* ❌ 禁止: セクション個別のpadding/margin定義 */
.ai-capabilities {
  padding: var(--spacing-16) 0;    /* ❌ 禁止 */
  margin: var(--spacing-8) 0;      /* ❌ 禁止 */
  margin-top: var(--spacing-12);  /* ❌ 禁止 */
  margin-bottom: var(--spacing-8); /* ❌ 禁止 */
}
```

### 3. 許可される個別設定
```css
/* ✅ 許可: 背景色での調整 */
.ai-capabilities {
  background: var(--color-primary-50);
}

/* ✅ 許可: カード内padding */
.capability-card {
  padding: var(--spacing-8);
}

/* ✅ 許可: リスト内padding */
.capability-card__list li {
  padding: var(--spacing-3) 0;
}
```

### 4. 統一管理される設定
- **セクションpadding**: `.section` クラスで統一管理
- **セクションmargin**: `.section` クラスで統一管理
- **セクション間隔**: デザインシステムで統一管理

## セクションコンテンツ構造のルール

### 1. 統一されたHTML構造
```html
<!-- 推奨: 統一されたセクション構造 -->
<section class="section-name">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">セクションタイトル</h2>
      <p class="section__subtitle">Subtitle</p>
    </div>
    <div class="section__content">
      <p class="section__description">説明文</p>
    </div>
  </div>
</section>
```

### 2. 禁止される個別セレクター
```html
<!-- ❌ 禁止: 個別のコンテンツラッパー -->
<div class="transition-content">
<div class="diversity-section__content">
<div class="custom-content-wrapper">
```

### 3. 統一されたCSS設定
```css
/* デザインシステムで統一管理 */
.section__content {
  margin: 0 auto;
  text-align: center;
  max-width: 1000px;
}
```

### 4. 禁止される個別CSS設定
```css
/* ❌ 禁止: 個別のコンテンツラッパー設定 */
.transition-content {
  margin: 0 auto;
  text-align: center;
  max-width: 1000px;
}

.diversity-section__content {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}
```

### 5. セクションコンテンツの用途
- **セクション説明文**: `.section__description` を `.section__content` で囲む
- **中央寄せ**: デフォルトで中央寄せ設定
- **最大幅制限**: 1000pxで統一（PC表示）
- **レスポンシブ**: デザインシステムで統一管理

### 6. 適用範囲
- **トップページ**: すべてのセクションで統一
- **下層ページ**: すべてのセクションで統一
- **個別ページ**: 特殊なレイアウト以外は統一

## ファイル統合手順

### 1. 個別ファイルの内容確認
```bash
# 個別ファイルの内容を確認
cat css/individual-file.css
```

### 2. 適切な共通ファイルに統合
```bash
# sections.css に統合
cat css/individual-file.css >> css/sections.css
```

### 3. HTMLファイルの参照を更新
```html
<!-- 削除 -->
<link rel="stylesheet" href="css/individual-file.css">

<!-- 既存の共通ファイルを使用 -->
<link rel="stylesheet" href="css/sections.css">
```

### 4. 個別ファイルを削除
```bash
rm css/individual-file.css
```

## チェックリスト

### 新規CSSファイル作成前
- [ ] 既存の共通ファイルで対応できないか確認
- [ ] 他のページでも使用される可能性がないか確認
- [ ] セクション専用のスタイルでないか確認

### セクション個別スタイル作成時
- [ ] セクション個別のpadding/margin定義を避けているか確認
- [ ] 背景色での調整のみを使用しているか確認
- [ ] カード内paddingは適切に設定されているか確認
- [ ] 統一管理される設定を個別定義していないか確認

### セクションコンテンツ構造作成時
- [ ] `.section__content` を使用しているか確認
- [ ] 個別のコンテンツラッパー（`.transition-content`など）を作成していないか確認
- [ ] セクション説明文は `.section__description` を使用しているか確認
- [ ] 統一されたHTML構造に従っているか確認

### ファイル統合時
- [ ] 既存のスタイルと競合しないか確認
- [ ] 適切なコメントを追加
- [ ] HTMLファイルの参照を更新
- [ ] 個別ファイルを削除

## 例外事項

### 許可される個別ファイル
1. **ページ専用の特殊スタイル**
   - 例: `numbers.css`（円グラフの特殊実装）
   - 例: `career-path.css`（キャリアパス図の特殊レイアウト）

2. **外部ライブラリのスタイル**
   - 例: `chart.css`（Chart.js用）
   - 例: `animation.css`（特殊アニメーション用）

### 禁止される個別ファイル
1. **セクション共通スタイル**
   - 例: `section-hero.css`
   - 例: `section-company.css`

2. **コンポーネント共通スタイル**
   - 例: `button.css`
   - 例: `card.css`

3. **セクションコンテンツ個別スタイル**
   - 例: `transition-content.css`
   - 例: `diversity-content.css`
   - 例: `custom-content-wrapper.css`

## メンテナンス

### 定期的な確認
- 月1回、個別ファイルの必要性を確認
- 統合可能なファイルがないかチェック
- 重複するスタイルがないか確認

### 新規開発時
- 必ず既存の共通ファイルを確認
- 個別ファイル作成前に承認を取得
- 統合可能な場合は統合を優先

---

**重要**: このルールに従わない場合は、ファイル統合を強制実行します。
