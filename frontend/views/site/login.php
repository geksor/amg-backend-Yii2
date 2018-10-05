<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper">
    <div class="index">
        <header class="header">
            <img src="/public/images/logo.svg" alt="mersedes-benz" class="logo_index">
        </header><!-- .header-->
        <main class="content index_margin">

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form', 'autocomplete' => 'off']]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Введите логин', 'class' => 'user'])->label(false) ?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'password', 'placeholder' => 'Введите пароль'])->label(false) ?>

            <?= Html::submitButton('Отправить', ['class' => 'submit', 'name' => 'login-button']) ?>

            <?= Html::a('Регистрация', '/site/signup-step-1', ['id' => 'registerLink']) ?>

            <?php ActiveForm::end(); ?>

        </main><!-- .content -->
        <footer  class="footer index_margin">
            <input id="checkBoxAgree" type="checkbox" checked> <span id="personalDataOpen">Согласие на обработку персональных данных</span>
        </footer><!-- .footer -->

        <div class="personal_data">
            <p>
                Пользовательское соглашение

                Настоящий документ «Пользовательское соглашение» представляет собой предложение АО «Мерседес-Бенц РУС» /
                Mercedes-Benz Russia AO договор на изложенных ниже условиях.

                1. Термины определения:

                Администрация Сайта — уполномоченные представители АО «Мерседес-Бенц РУС» / Mercedes-Benz Russia AO

                Пользователь — дееспособное физическое лицо, прошедшее процедуру регистрации на Сайте и присоединившееся
                к настоящему Соглашению в собственном интересе либо выступающее от имени и в интересах представляемого
                им юридического лица, которое совершает целенаправленные действия относительно доступа к страницам
                сайта, к его сервисам и пр.

                Посетитель — незарегистрированное или неавторизованное на Сайте лицо. Посетителю доступен только
                просмотр общедоступных страниц Сайта.

                Сервисы Сайта — функциональные службы и инструменты, обеспечиваемые программным обеспечением Сайта и
                доступные для Пользователей и (или) Посетителей. Администрация Сайта вправе самостоятельно и без
                уведомления Пользователей и (или) Посетителей изменять Сервисы Сайта и их функциональные особенности.

                Контент — результаты интеллектуальной деятельности, составляющие информационное наполнение Сайта
                (тексты, фотографии, видео и пр.).

                Аккаунт — учетная запись Пользователя на Сайте, создаваемая в результате регистрации, посредством
                которой Пользователь использует Сервисы Сайта.

                Соглашение — настоящее соглашение со всеми дополнениями и изменениями, определяющее порядок
                предоставления услуг, а также взаимные права, обязанности и порядок взаимоотношений между Администрацией
                Сайта и Пользователем и (или) Посетителем.

                Сайт — совокупность информации и объектов интеллектуальной собственности (в том числе, программа для
                ЭВМ, база данных, графическое оформление интерфейса (дизайн) и др.), доступ к которому обеспечивается с
                различных пользовательских устройств, подключенных к сети Интернет, посредством специального
                программного обеспечения для просмотра веб-страниц (браузер) по адресу http://mynt2018.ru (включая домены
                следующих уровней).

                1. Общие положения

                Использование материалов и Сервисов Сайта регулируется нормами действующего законодательства Российской
                Федерации.

                Настоящее Соглашение является публичной офертой. Получая доступ к материалам Сайта Пользователь и (или)
                Посетитель считается присоединившимся к настоящему Соглашению.

                Помимо настоящего Соглашения к отношениям между Пользователем, Посетителем и Администрацией Сайта
                относятся все специальные документы, регулирующие предоставление отдельных услуг и Сервисов Сайта и
                размещенные в открытом доступе в соответствующих разделах Сайта.

                Принимая условия настоящего Соглашения, Пользователь подтверждает свое согласие на получение, обработку
                и хранение Администрацией Сайта его персональных данных, размещаемых Пользователем добровольно на Сайте.
                Получение, обработка, хранение и раскрытие персональных данных Пользователя осуществляется в
                соответствии с законодательством Российской Федерации и в целях предоставления Пользователю существующих
                и новых услуг и Сервисов Сайта, в том числе, в целях получения Пользователем персонализированной,
                таргетированной рекламы.

                Администрация Сайта оставляет за собой право вносить изменения в настоящем Соглашение. Новая редакция
                Соглашения вступает в силу с момента ее размещения на Сайте.

                Начиная использовать какой-либо сервис/его отдельные функции, либо пройдя процедуру регистрации,
                Пользователь считается принявшим условия Соглашения в полном объеме, безо всяких оговорок и исключений,
                и обязуется соблюдать их или прекратить использование Сайта. В случае если Администрацией Сайта были
                внесены какие-либо изменения в Соглашение в порядке, предусмотренном пунктом 1.5 Соглашения, с которыми
                Пользователь не согласен, он обязан прекратить использование Сервисов Сайта.

                2. Обязательства Пользователя

                Пользователь, посетитель обязуется не предпринимать действий и не размещать материалов, нарушающих
                действующее российское законодательство или нормы международного права, в том числе в сфере
                интеллектуальной собственности, авторских и/или смежных правах, или общепринятых норм морали и
                нравственности, а также любых действий, которые приводят или могут привести к нарушению нормальной
                работы Сайта и Сервисов Сайта.

                Информация, размещаемая Пользователем, и его действия на Сайте также не должны быть ложными, неточными
                или вводящими в заблуждение; способствовать мошенничеству, обману или злоупотреблению доверием и иным
                образом нарушать действующее законодательство РФ.

                Использование материалов Сайта без согласия правообладателей не допускается. Для правомерного
                использования материалов Сайта необходимо заключение лицензионных договоров (получение лицензий) от
                правообладателей. При цитировании материалов Сайта, включая охраняемые авторские произведения, ссылка на
                Сайт обязательна.

                Пользователь самостоятельно несет ответственность за все действия с использованием его электронного
                адреса, логина (имени пользователя) и пароля. Выбранные Пользователем логин (e-mail) и пароль являются
                необходимой и достаточной информацией для доступа Пользователя на Сайт.

                Пользователь обязуется не предпринимать действий, направленных на причинение вреда Сайту, его сервисам.

                3. Права пользователя, посетителя

                Пользователь, посетитель имеет право принимать участие в конкурсах и акциях, проводимых на Сайте.
                Условия и положения акций и конкурсов излагаются в отдельных документах.

                Пользователь имеет право размещать не нарушающую закон информацию на сайте на правах пре- и
                постмодерации.

                Пользователь, посетитель имеет право обращаться к Администрации Сайта в письменной форме через форму
                обратной связи по вопросам работы Сайта, а также представлять Администрации Сайта замечания и пожелания
                относительно улучшения Сайта.

                4. Права Администрации Сайта

                Администрация Сайта вправе в одностороннем порядке вносить изменения в условия настоящего Соглашения,
                публикуя изменённый текст на Сайте. При несогласии Пользователя, посетителя с внесенными изменениями он
                обязан прекратить использование Сайта, материалов и Сервисов Сайта.

                Администрация Сайта имеет право по своему усмотрению вводить, отменять или изменять плату за
                предоставляемые Сайтом Сервисы и услуги.

                Администрация Сайта вправе организовывать различные конкурсы и акции для стимулирования Пользователей
                Сайта.

                Администрация Сайта вправе направлять Пользователю рассылки с информацией о развитии Сайта, о новых
                предложениях, а также с рекламой.

                Администрация Сайта имеет право проводить профилактические работы с временным приостановлением работы
                Сайта как с уведомлением, так и без предварительного уведомления Пользователей.

                дминистрация Сайта имеет право запретить использование определенных логинов и/или изъять их из
                обращения. В качестве логина не могут быть выбраны слова и наименования, использование которых запрещено
                действующим законодательством Российской Федерации и международными правовыми актами, в том числе, но не
                ограничиваясь, нецензурная лексика, наименования, зарегистрированные как товарные знаки, фирменные
                наименования и коммерческие обозначения, если Пользователю не принадлежат исключительные права на них.

                Администрация Сайта оставляет за собой право по своему усмотрению изменять (модерировать) или удалять
                любую публикуемую Пользователем информацию.

                5. Регистрация на сайте

                Пользователь может зарегистрироваться на Сайте любым из следующих способов:

                Посредством ввода в регистрационную форму на Сайте имени, адреса электронной почты и телефона, а также
                ответа на контрольный вопрос. Один адрес электронной почты и телефон может использоваться в качестве
                логина одного Аккаунта.

                Посредством авторизации через социальные сети с последующим вводом адреса электронной почты и телефона.

                Пройдя регистрацию на Сайте, Пользователь получает Аккаунт.

                Пользователь гарантирует достоверность и актуальность сообщаемых им при регистрации данных.

                Администрация Сайта хранит адреса электронной почты Пользователей обезличенно, т. е. без привязки к
                конкретному лицу, и использует их исключительно в целях исполнения своих обязательств и осуществления
                своих прав по Соглашению.

                6. Интеллектуальная собственность

                Все объекты на Сайте, в том числе элементы дизайна, текст, графические изображения, иллюстрации, видео,
                программы для ЭВМ, базы данных и другие объекты являются объектами исключительных прав.

                Никакие объекты интеллектуальной собственности, размещенные на Сайте Администрацией Сайта, не могут быть
                использованы без предварительного письменного разрешения Администрации Сайта. Под использованием
                подразумеваются все действия Пользователя, перечисленные в части 2 статьи 1270 ГК РФ, независимо от
                того, совершаются ли соответствующие действия в целях извлечения прибыли или без такой цели.

                Пользователю, Посетителю предоставляется личное неисключительное и непередаваемое право использовать
                Сайт, при условии, что ни сам Пользователь, Посетитель ни любые иные лица при содействии с его стороны
                не будут копировать или изменять программное обеспечение или объекты интеллектуальной собственности на
                Сайте; создавать программы, производные от программного обеспечения; проникать в программное обеспечение
                с целью получения кодов программ; осуществлять продажу, уступку, сдачу в аренду, передачу третьим лицам
                в любой иной форме прав в отношении программного обеспечения, предоставленных Пользователю, Посетителю
                по Соглашению, а также модифицировать службы, в том числе с целью получения несанкционированного доступа
                к ним.

                7. Прочие условия

                Все возможные споры, вытекающие из настоящего Соглашения или связанные с ним, подлежат разрешению в
                соответствии с действующим законодательством Российской Федерации.

                Ничто в Соглашении не может пониматься как установление между Пользователем, Посетителем и Администрации
                Сайта агентских отношений, отношений товарищества, отношений по совместной деятельности, отношений
                личного найма, либо каких-то иных отношений, прямо не предусмотренных Соглашением.

                Признание судом какого-либо положения Соглашения недействительным или не подлежащим принудительному
                исполнению не влечет недействительности иных положений Соглашения.

                Бездействие со стороны Администрации Сайта в случае нарушения кем-либо из Пользователей, Посетителей
                положений Соглашения не лишает Администрацию Сайта права предпринять позднее соответствующие действия в
                защиту своих интересов и защиту авторских прав на охраняемые в соответствии с законодательством
                материалы Сайта.

                Пользователь, Посетитель подтверждает, что ознакомлен со всеми пунктами настоящего Пользовательского
                Соглашения и безусловно принимает их.
                
                <button id="personalDataClose" class="submit">Ок</button>
            </p>
        </div> <!-- -->

    </div> <!--Главный-->
</div>
