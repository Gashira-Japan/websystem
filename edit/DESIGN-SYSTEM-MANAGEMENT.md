# テンファイブデザインシステム統一管理ガイド

## 🎯 目的

テンファイブの全サイト（コーポレートサイト、採用サイト）で統一されたデザインシステムを維持し、効率的な開発と保守を実現する。

## 📁 ファイル構成

```
DesignSystem/
├── shared-design-tokens.json          # 統一デザイントークン
├── DESIGN-SYSTEM-MANAGEMENT.md        # このファイル
├── tenfive-recruit-clean/             # 採用サイト
│   └── css/design-system.css          # 採用サイト用CSS変数
└── tenfive-corporate/                 # コーポレートサイト
    └── css/design-system.css          # コーポレートサイト用CSS変数
```

## 🔄 統一管理の仕組み

### 1. マスターファイル
- `shared-design-tokens.json` が**唯一の真実の源（Single Source of Truth）**
- 全てのデザイントークンはここで定義・管理

### 2. 同期プロセス
各サイトの `design-system.css` は `shared-design-tokens.json` から生成・同期

### 3. テーマ別の差別化
- **共通要素**: フォント、スペーシング、基本カラー
- **テーマ固有**: プライマリ、セカンダリ、アクセントカラー

## 📋 統一されている要素

### ✅ 完全統一
- **フォントサイズ**: `--font-size-xs` 〜 `--font-size-6xl`
- **スペーシング**: 8pxベースの `--spacing-0` 〜 `--spacing-24`
- **フォントファミリー**: Noto Sans JP, Inter, JetBrains Mono
- **フォントウェイト**: light, normal, medium, semibold, bold
- **ボーダーラディウス**: sm, base, md, lg, xl, full
- **シャドウ**: sm, base, md, lg, xl
- **トランジション**: fast, normal, slow
- **ブレークポイント**: sm, md, lg, xl, 2xl

### 🎨 テーマ別差別化
| 要素 | コーポレート | 採用サイト |
|------|-------------|------------|
| プライマリ | ブルー系（信頼性） | ブルー系（同一） |
| セカンダリ | グレー系（安定感） | グリーン系（親しみやすさ） |
| アクセント | グリーン系（革新） | オレンジ系（活力） |

## 🔧 更新手順

### 新しい要素の追加
1. `shared-design-tokens.json` に追加
2. 各サイトの `design-system.css` を更新
3. 変更内容をテスト
4. ドキュメントを更新

### 既存要素の変更
1. `shared-design-tokens.json` で変更
2. **全サイト** で `design-system.css` を同期
3. ビジュアルリグレッションテスト
4. 必要に応じてコンポーネントを調整

### テーマ固有の変更
1. 該当テーマのセクションのみ変更
2. 他のテーマに影響しないことを確認
3. 変更内容をドキュメント化

## 📝 CSS変数の命名規則

### 基本構造
```css
--{category}-{element}-{variant}
```

### 例
```css
/* カラー */
--color-primary-500
--color-secondary-600
--color-accent-700

/* スペーシング */
--spacing-4        /* 16px */
--spacing-lg       /* エイリアス */

/* タイポグラフィ */
--font-size-xl
--font-weight-semibold
--line-height-relaxed
```

## 🚨 注意事項

### 絶対に守るべきルール
1. **直接的なハードコーディング禁止**
   ```css
   /* ❌ 悪い例 */
   font-size: 18px;
   
   /* ✅ 良い例 */
   font-size: var(--font-size-lg);
   ```

2. **共有トークン以外での定義禁止**
   ```css
   /* ❌ 悪い例 */
   --custom-spacing: 20px;
   
   /* ✅ 良い例 */
   --spacing-5  /* 既存のトークンを使用 */
   ```

3. **サイト固有のCSS変数は最小限に**
   ```css
   /* ✅ 許可される例（サイト固有のレイアウト） */
   --header-height: 4rem;
   --container-max-width: 1200px;
   ```

## 🔍 チェックリスト

### 新しいコンポーネント作成時
- [ ] 共有トークンを使用しているか
- [ ] ハードコーディングがないか
- [ ] レスポンシブ対応しているか
- [ ] アクセシビリティを考慮しているか

### デザインシステム更新時
- [ ] `shared-design-tokens.json` を更新したか
- [ ] 全サイトで同期したか
- [ ] ビジュアルテストを実行したか
- [ ] ドキュメントを更新したか

## 📊 バージョン管理

### セマンティックバージョニング
- **MAJOR**: 破壊的変更（例：フォントサイズの大幅変更）
- **MINOR**: 新機能追加（例：新しいカラーバリエーション）
- **PATCH**: バグ修正（例：カラー値の微調整）

### 変更履歴
```json
{
  "version": "1.0.0",
  "changes": [
    "初回リリース",
    "コーポレート・採用サイト用テーマ定義"
  ]
}
```

## 🛠️ 開発ツール

### 推奨ツール
- **CSS Variables**: ブラウザ開発者ツールでリアルタイム確認
- **Design Tokens**: Figma連携（将来実装予定）
- **Storybook**: コンポーネント管理（将来実装予定）

### デバッグ方法
```css
/* デバッグ用（本番では削除） */
* {
  outline: 1px solid red !important;
}
```

## 📞 サポート

### 質問・問題報告
- デザインシステムに関する質問
- 統一性の問題発見
- 新機能の提案

### 定期的な見直し
- **月次**: 使用状況の確認
- **四半期**: デザイントークンの見直し
- **年次**: 全体アーキテクチャの評価

---

## 📚 参考資料

- [Design Tokens W3C Community Group](https://design-tokens.github.io/community-group/)
- [CSS Custom Properties (Variables)](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)
- [Semantic Versioning](https://semver.org/)

---

**最終更新**: 2025-01-27  
**バージョン**: 1.0.0  
**管理者**: テンファイブ開発チーム
