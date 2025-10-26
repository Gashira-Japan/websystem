# Claudeへの最初の指示文

## コピペ用指示文

```
あなたはフロントエンド実装者です。次の制約で作業してください。

【リポジトリとブランチ】
- リポ: https://github.com/Gashira-Japan/websystem
- 作業ブランチ: claude/redesign-<日付>-<短い説明> を自分で作成しpush
- 最終的に takayuki/edit 宛てにPRを出すこと（base: takayuki/edit, head: 作業ブランチ）

【コード参照の優先順位】
1) tenfive-recruit-clean/ （現行の正）
2) project-brief/DESIGN_SYSTEM.md（デザイントークン/コンポーネント）
3) project-brief/MAPPING_OLD_WP.md（旧WPとの対応）
4) old-wordpress/ （素材・テキスト参照のみ。設計は持ち込まない）

【やること】
- 下層ページを1ページずつ実装する。最初は project-brief/PAGE_SPECS/<対象>.md に従う。
- 既存テンプレート（templates/page-template.html, templates/section-template.html など）を再利用。
- 直値の色/サイズは禁止。必ずデザイントークンを参照。
- 画像は /tenfive-recruit-clean/assets/ 下に配置し、webp優先。必要なら既存jpg/pngも残す。
- CSSは既存の構造に合わせ、差分は components/_local-<slug>.scss に限定。
- 作業のたびに以下を実施：
  - 変更点の要約（どのコンポーネントを使い、旧WPのどの要素をどう移植したか）
  - チェックリストの自己評価（OK/要相談）

【出力物】
- コード変更（コミットを小さく）：feat: <page> セクションA、fix: レスポンシブ など
- takayuki/edit へのPR（テンプレに沿って記載）
- 未確定事項がある場合は「Pending」としてPR本文に列挙

まずは `in-numbers` を実装。問題なければ続けて他のPAGE_SPECSも順番に進める。
```

## 実務の回し方

### 1. 準備
1. `project-brief/` をコミット → main に置く（基準として固定）
2. Claudeに「最初の指示文」を投入

### 2. 作業フロー
1. ClaudeのPR（claude/redesign-* → takayuki/edit）をレビュー
2. OKなら takayuki/edit → main のPRを作りマージ
3. v0.2 などタグを付けてスナップショット

### 3. うまく回すコツ
- **1PR=1ページ or 1セクションに限定**（レビューが速く、巻き戻しも楽）
- **「設計逸脱」を検知**するため、直書きCSSや独自クラスの禁止を明示
- **旧WPの独自JS/CSSは基本持ち込まない**。必要時は"移植理由"をPR本文に書かせる
- **画像・文言は"出典"を記録**（旧WPのどのファイル/URLか）
- **自動整形（Prettier）と簡易Linter**があると安定します

## 作業単位の例

### 第1回：In Numbersページ
- ヒーローセクション
- 統計グリッドセクション
- CTAセクション

### 第2回：業界構造ページ
- ヒーローセクション
- 業界分析セクション
- 強みセクション

### 第3回：キャリアパスページ
- ヒーローセクション
- キャリアタイムライン
- スキルセクション

## 注意事項

1. **コンテキストをきっちり渡す** - project-brief/の内容を必ず参照
2. **作業単位を小さく切る** - 1PR=1ページに限定
3. **PRで検収** - レビュー観点を明確に
4. **未確定事項はPending** - PR本文に列挙
5. **出典を記録** - 旧WPのどのファイルから移植したかを明記
