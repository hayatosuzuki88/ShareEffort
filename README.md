# Share Effort
<img src="https://github.com/user-attachments/assets/35b3c0de-7f55-493c-8187-278bdbcb4e95?raw=true" alt="Example Image" width="400" />

## URL
https://shareeffort-eae8f3c7726a.herokuapp.com

## 概要
SNS×目標タスク管理アプリ

夢のために目標を設定し、そのために計画を組むことや実行することは難しい。本アプリは目標から簡単に計画を組むことができ、友達に応援やアドバイスをしてもらうことで実行しやすくする環境を提供します。

## 作成背景

### 目標タスク管理について
私は塾講師としてアルバイトをする中で、たくさんの生徒の目標に携わってきました。「目標設定」→「計画」→「実行」→「振り返り」というプロセスは大事ですが、意識するのは難しいです。このプロセスを容易に行えるようにIT技術を利用していきたいです。

### SNS機能について
人は様々なことに時間を割いていますが、SNSではいいところだけが強調されがちです。このアプリでは、日々の苦労も努力であり、共有することでお互いを応援し合える相乗効果を生み出したいと考えています。

### ユーザーのニーズ
私がアルバイトをしている塾の受験生はスマホを触らないようにＳＮＳをアンインストールしたと話してくれました。実際、私が高校生の頃もアプリの誘惑に負けないように制限をかけていました。勉強の邪魔になるＳＮＳではなく、勉強の味方をしてくれるＳＮＳがあったらいいなと思い、このアプリを作成しました。

## 制作期間
3ヶ月

## 使用した環境
### 言語
- **PHP**
- **JavaScript**
- **HTML**
- **CSS**
### ライブラリ
- **Laravel**
- **JQuery**

## 使い方

### 1. ユーザー登録
- **サインアップ**: ログイン画面にある「サインアップ」ボタンをクリックします。
<img src="https://github.com/user-attachments/assets/8f5dd94f-0cb7-4c57-b665-8ad0adc29548?raw=true" alt="Example Image" width="400" />

- **登録情報**: 登録画面で、名前、メールアドレス、パスワードを入力してアカウントを作成します。
<img src="https://github.com/user-attachments/assets/0dc40aa6-1f8d-46d4-8828-7a6834adf04f?raw=true" alt="Example Image" width="400" />


### 2. 目標の設定
- **タスク管理画面**: ヘッダーにある「Task」ボタンをクリックしてタスク管理画面に移動します。
- **ゴールの作成**:
  - 「Goal」ボタンをクリックすると、ゴール作成モーダルが表示されます。
<img src="https://github.com/user-attachments/assets/54da327c-3f44-4737-92ed-1f84cd114595?raw=true" alt="Example Image" width="800" />

  - ゴールの達成時期とゴール名を入力して登録します。

<img src="https://github.com/user-attachments/assets/6bc7cb75-281f-42e1-b489-9caea19454fb?raw=true" alt="Example Image" width="300" />

### 3. プランの作成
- **タスク管理画面**: 再度、ヘッダーの「Task」ボタンをクリックします。
- **プランの作成**:
  - 「Plan」ボタンをクリックしてプラン作成モーダルを開きます.

  - プランの作業概要、実施期間、作業にかかる時間、作業範囲（例: ページ数）、取り組む時間、実施間隔（日数）、目指すゴールを入力して登録します。

<img src="https://github.com/user-attachments/assets/ecf5b9a8-8632-4936-8b50-ad55cca8cff4?raw=true" alt="Example Image" width="300" />

  - **タスクの自動生成**: 登録したプランに基づいて、自動的にタスクが生成されます。

### 4. タスクの実施
- **Postの投稿**: タスクを実施したら、Postを投稿します。
<img src="https://github.com/user-attachments/assets/6bd50060-7b1e-4ace-8702-780d09dbf990?raw=true" alt="Example Image" width="800" />
<img src="https://github.com/user-attachments/assets/56b9f692-bbd3-4880-befb-469cc641cb8c?raw=true" alt="Example Image" width="400" />

  - 投稿には「いいね」や「コメント」をもらうことができます。
  - コメントは「アドバイス」または「応援」を選択できます。
- **友達機能**: 友達になったユーザーのRoutineやPostがホーム画面に表示されます。
<img width="800" alt="home" src="https://github.com/user-attachments/assets/564dc0a8-5cd7-431c-8ed4-7bd56165097d">

### 5. タスクの確認
- **ホーム画面**: 今日実施するタスクが表示されます。
- **カレンダー**: タスク管理画面にあるカレンダーで、今日より先のタスクを確認できます。
<img src="https://github.com/user-attachments/assets/dbffdb67-129a-4ba3-8236-6e01d2b89916?raw=true" alt="Example Image" width="800" />

### 6. タスクの状態
- **カレンダー表示**: 
  - 未実施のタスクは灰色で表示され、実施済みのタスクは赤色で表示されます。

### その他
- **Routineの投稿**: ゴールに関係なく、頑張ったこと（家事や通学など）をRoutineとして投稿することができます。

## テストアカウント
### メールアドレス
test.share.effort@gmail.com
### パスワード
shareeffort

## ライセンス
このプロジェクトは [MIT License](LICENSE) の下でライセンスされています。
