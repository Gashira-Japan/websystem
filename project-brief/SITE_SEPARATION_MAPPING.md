# サイト分離マッピング - 旧WordPress → 新構成

## 概要
旧WordPressサイトを **コーポレートサイト (corporate)** と **採用サイト (recruit-clean)** の2つに分離

## 1. 採用サイト (recruit-clean)

### 対象URL
- **メインページ**: `/` (採用トップ)
- **メンバー**: `/member/` ※新規実装が必要

### 旧WordPressテンプレートとの対応

| 旧WP URL | 旧WPテンプレート | 新実装状態 | 備考 |
|---------|----------------|-----------|------|
| `/recruit/` | `page-recruit.php` | `index.html` | 既存実装あり |
| `/new-grad/` | `page-new-grad.php` | `pages/new-grad/index.html` | 既存実装あり |
| `/mid-career/` | `page-mid-career.php` | `pages/mid-career/index.html` | 既存実装あり |
| `/member/[slug]/` | `single-member.php` | **未実装** | 🔴 要実装 |
| `/in-numbers/` | (推定) | `pages/in-numbers.html` | サンプル実装 |
| `/career-path/` | (推定) | `pages/career-path.html` | サンプル実装 |
| `/ses-sier-industry-structure/` | (推定) | `pages/ses-sier-industry-structure.html` | サンプル実装 |
| `/schedule/` | (推定) | `pages/schedule.html` | 既存実装あり |
| `/events/` | (推定) | `pages/events.html` | 既存実装あり |
| `/ideal-candidate/` | (推定) | `pages/ideal-candidate.html` | 既存実装あり |
| `/faq/` | (推定) | `pages/faq.html` | 既存実装あり |
| `/company/` | (推定) | `pages/company.html` | 既存実装あり |
| `/history/` | (推定) | `pages/history.html` | 既存実装あり |

### 実装優先順位
1. **HIGH**: `/member/` - メンバー一覧・個別ページ（旧WP `single-member.php` から移植）
2. **MEDIUM**: サンプルページの本番コンテンツ化
   - `in-numbers.html` - 旧WPデータから実数値を取得
   - `career-path.html` - 旧WPデータから実コンテンツを取得
   - `ses-sier-industry-structure.html` - 旧WPデータから実コンテンツを取得

---

## 2. コーポレートサイト (corporate)

### 対象URL（ユーザー指定）
- `/service/` - サービス紹介
- `/company/` - 会社概要
- `/news/` - ニュース
- `/blog-tenfive/curriculum/` - ブログ（カリキュラムカテゴリー）
- `/ai-tool/` - AIツール
- `/partners/` - パートナー
- `/contact/` - お問い合わせ
- `/erp/` - ERP LP
- `/ai-object-detection/` - AI物体検出 LP
- `/nlp/` - 自然言語処理 LP
- `/privacy/` - プライバシーポリシー

### 旧WordPressテンプレートとの対応

| 旧WP URL | 旧WPテンプレート | 新実装状態 | 備考 |
|---------|----------------|-----------|------|
| `/service/` | `page.php` | **未実装** | 🔴 要実装 |
| `/company/` | `page.php` | **未実装** | 🔴 要実装（採用側とは別） |
| `/news/` | `archive.php` | **未実装** | 🔴 要実装 |
| `/blog-tenfive/curriculum/` | `taxonomy-blog-tenfive_category-curriculum.php` | **未実装** | 🔴 要実装 |
| `/ai-tool/` | `archive-ai-tool.php` | **未実装** | 🔴 要実装 |
| `/partners/` | `page.php` | **未実装** | 🔴 要実装 |
| `/contact/` | `page.php` | **未実装** | 🔴 要実装 |
| `/erp/` | `page-lp.php` | **未実装** | 🔴 要実装 |
| `/ai-object-detection/` | `page-lp.php` | **未実装** | 🔴 要実装 |
| `/nlp/` | `page-lp.php` | **未実装** | 🔴 要実装 |
| `/privacy/` | `page.php` | **未実装** | 🔴 要実装 |

### ディレクトリ構造（提案）

```
/websystem/
├── edit/
│   ├── tenfive-recruit-clean/    # 採用サイト（既存）
│   └── tenfive-corporate/        # コーポレートサイト（新規作成）
│       ├── assets/
│       ├── css/
│       ├── js/
│       ├── pages/
│       │   ├── service/
│       │   ├── company/
│       │   ├── news/
│       │   ├── blog-tenfive/
│       │   ├── ai-tool/
│       │   ├── partners/
│       │   ├── contact/
│       │   ├── lp/
│       │   │   ├── erp/
│       │   │   ├── ai-object-detection/
│       │   │   └── nlp/
│       │   └── privacy/
│       ├── templates/
│       └── index.html
```

---

## 3. 共通アセット

### 画像ソース
- `/old-wordpress/old-tenfive-wordpress/img/recruit/` → `/tenfive-recruit-clean/assets/images/`
- `/old-wordpress/old-tenfive-wordpress/img/company/` → 両サイトで使用可能
- `/old-wordpress/old-tenfive-wordpress/img/common/` → 両サイトで使用可能

### デザインシステム
- **採用サイト**: `edit/tenfive-recruit-clean/` の既存デザインシステムを使用
- **コーポレートサイト**: 新規作成（または採用サイトのデザインシステムを共有）

---

## 4. 実装戦略

### フェーズ1: 採用サイト完成
1. `/member/` ページの実装
2. サンプルページの本番コンテンツ化
3. 既存ページの最終調整

### フェーズ2: コーポレートサイト構築
1. ディレクトリ構造作成
2. デザインシステム構築（採用サイトと共有または独立）
3. 各ページの実装
   - 優先度HIGH: `/service/`, `/company/`, `/news/`, `/contact/`
   - 優先度MEDIUM: `/ai-tool/`, `/partners/`, `/privacy/`
   - 優先度LOW: LP系（`/erp/`, `/ai-object-detection/`, `/nlp/`）

### フェーズ3: 統合とテスト
1. 両サイトのリンク確認
2. SEO対策
3. パフォーマンス最適化

---

## 5. 未確定事項

### 確認が必要な項目
- [ ] コーポレートサイトのデザインシステムは採用サイトと共有するか？
- [ ] `/company/` ページは採用サイトとコーポレートサイトで内容が異なるか？
- [ ] `/blog-tenfive/curriculum/` 以外のブログカテゴリーの扱いは？
- [ ] ニュース (`/news/`) は採用サイトにも必要か？
- [ ] メンバーページ (`/member/`) は一覧ページも必要か？

---

## 次のステップ

### 即座に実装可能
1. **採用サイト**: `/member/` ページの実装
   - 参照: `old-wordpress/old-tenfive-wordpress/single-member.php`
   - 参照: `old-wordpress/old-tenfive-wordpress/img/company/member*.jpg`

### 確認後に実装
2. **コーポレートサイト**: ディレクトリ構造の作成とデザインシステムの決定

---

## 参考情報

### 旧WordPressの主要ファイル
- `page-recruit.php` - 採用トップ（Culture, Service, WorkStyle, Entry, Access セクション）
- `single-member.php` - メンバー個別ページ
- `archive-ai-tool.php` - AIツール一覧
- `taxonomy-blog-tenfive_category-curriculum.php` - カリキュラムブログ
