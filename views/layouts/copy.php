<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\jui\JuiAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
JuiAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link href="/css/scroll.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="loader"></div>

<div class="sidebar">
    <div class="admin">
        <div class="photowrapper">
            <img src="/images/woman.png">
        </div>
        <h3>Татьяна</h3>
        <div class="adminStatus">Администратор</div>
        <div class='moneyNow'>В кассе: <a href=""> 500 р.</a> </div>
    </div>
    <div class='sideBarNav'>
        <ul>
            <li class='active tab1 '><i class="fa fa-sliders"></i></li>
            <li class='tab2 '><i class="fa fa-smile-o "></i></li>
            <li class='tab3 '>
                <span></span>
                <i class="fa fa-bell"></i>
            </li>
            <li class='tab4'>
                <span>1</span>
                <i class="fa fa-calendar"></i>
            </li>
        </ul>
    </div>
    <nav class="menu">
        <div class='sideBarSettings tabs tab1'>
            <p>Основоное меню</p>
            <ul>
                <li>
                    <a href="/calendar" class="">
                        <i class="fa fa-calendar-o"></i>Календарь и задачи
                    </a>
                </li>

                <li>
                    <span><i class="fa fa-leanpub"></i> Записи<i class="arr fa fa-angle-left"></i></span>
                    <ul>
                        <li>
                            <a href='/visit/index ' class="">
                                Новый визит</a>
                        </li>
                        <li>
                            <a href='/entry/create ' class="">
                                Предварительная запись</a>
                        </li>
                        <li>
                            <a href='/entry/index ' class="">
                                Журнал записей</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/clients" class="">
                        <i class="fa fa-users"></i>Клиенты
                    </a>
                </li>
                <li>
                    <a href="/contractors" class="">
                        <i class="fa fa-users"></i>Контрагенты
                    </a>
                </li>

                <li>
                    <span><i class="fa fa-envelope-o"></i> Смс-сервис<i class="arr fa fa-angle-left"></i></span>
                    <ul>
                        <li>
                            <a href='/promotion/index' class="">Акции</a>
                        </li>
                        <li><a href="/sms" class="">
                                Настройка СМС-сервиса</a>
                        </li>
                        <li><a href="">Отчет по смс</a></li>
                    </ul>
                </li>
                <li>
                    <span><i class="fa fa-usd"></i> Финансы<i class="arr fa fa-angle-left"></i></span>
                    <ul>
                        <li><a href="/finance/income-and-expense">Приход и расход средств</a></li>
                        <li><a href="/finance/moving">Перемещение средств</a></li>
                        <li><a href="/finance/cash">Кассы и счета</a></li>
                        <li><a href="/income-and-expense">Статьи доходов и расходов</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <span><i class="fa fa-leanpub"></i> Склад</span>
                    <ul>
                        <li><a href="">Поступление товаров</a>
                        </li>
                        <li><a href="">Списание товаров</a>
                        </li>
                        <li><a href="">Товары на складе</a>
                        </li>
                    </ul>
                </li> -->

                <li>
                    <a href="/schedule" class="active">
                        <i class="fa fa-book"></i> Графики работы
                    </a>
                </li>

                <li>
                    <span><i class="fa fa-cogs"></i> Настройки<i class="arr fa fa-angle-left"></i></span>
                    <ul>
                        <li>
                            <a href="/master/index" class="">
                                Специалисты                            </a>
                        </li>
                        <li>
                            <a href="/employees" class="">
                                Сотрудники
                            </a>
                        </li>
                        <li>
                            <a href="/services" class="">
                                Услуги
                            </a>
                        </li>
                        <li>
                            <a href="/profile" class="">
                                Настройка профиля
                            </a>
                        </li>
                        <li><a href="/payment" class="">
                                Оплата подписки
                            </a>
                        </li>

                        <li><a href="">Интеграция на сайт</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class='workToday tab2 tabs none'>
            <p>Сегодня работают</p>
            <ul class='workingNow'>
            </ul>
            <p>Завтра работают</p>
            <ul class='workingTomorrow'>
            </ul>
        </div>
        <div class='alertsSidebar tab3 tabs none'>
            <p>Новые записи</p>
            <ul class='newClientsSidebar' id="newClients">
            </ul>
            <p>Ожидаются</p>
            <ul class='allClientsSidebar'>
            </ul>
        </div>
        <div class='alertsSidebar tab4 tabs none'>
            <p>Задачи на сегодня</p>
            <ul class='newClientsSidebar' id="newCal">
            </ul>
            <p>Задачи на завтра</p>
            <ul class='allClientsSidebar'>
            </ul>
        </div>
    </nav>
</div>                            <header>
    <div class="header__logo">
        <a href="/" class="header__logo-link">Alpha Clients</a>
    </div>
    <article class="profile">
        <ul>
            <li>
                <a href="/support"><i class="fa fa-life-ring"></i>Поддержка</a>
            </li>
            <li>
                <a href="#"> <i class="fa fa-user"></i>Обучение</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-credit-card"></i>Интеграция на сайт</a>
            </li>
            <li>
                <a rel="nofollow" data-method="delete" href="/logout" class="active"><i class="fa fa-sign-out"></i>Выход</a>
            </li>
        </ul>
    </article>

</header>                <div id="content">

<script>
    var urlFeed = '/schedule/feed';
    var urlUpdateDay = '/schedule/update-day';
    var openDayStartTime = '10:00:00';
    var openDayEndTime = '20:00:00';
</script>
<div class="clear" id="mainContent">
    <div class="head">
        <h2>Графики работ</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">

                <div class="col-md-12">

                    <div class="contentOver specialists">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mastersGraph graph">
                                    <div class="master checked"
                                         data-master-id="7">
                                        <div class="photowrapper">
                                            <img src="/images/man.png">
                                        </div>
                                        <div
                                            class="name">Инна Красовская</div>
                                        <div class="profession">Директор</div>
                                    </div>
                                    <div class="master"
                                         data-master-id="9">
                                        <div class="photowrapper">
                                            <img src="/images/woman.png">
                                        </div>
                                        <div
                                            class="name">Алиса Ваучер</div>
                                        <div class="profession">Специалист</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="paddingWrap">

                                    <div id='schedule' class='calendar schedule'></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" paddingWrap form-horizontal  ">
                                    <div class=" well">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <h5>Шаблон для автозаполнения графика&nbsp;<a class="help-s"
                                                                                              id="master-help">
                                                        &nbsp;</a></h5>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">График</label>

                                            <div class="col-sm-3">
                                                <select name="shed_pat_count" id="shed_pat_count_id"
                                                        class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2" selected="">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2 text-center p-xxs">через</div>
                                            <div class="col-sm-3">
                                                <select name="shed_pat_after" id="shed_pat_after_id"
                                                        class="form-control">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2" selected="">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Начиная с</label>

                                            <div class="col-sm-6 p-xs">
                                                <input type="text" name="shed_date" id="tpl_date" class="hasDatepicker">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Время работы</label>

                                            <div class="col-sm-4">
                                                <select name="shed_pat_time_start" id="shed_pat_time_start_id"
                                                        class="form-control">
                                                    <option value="0">00:00</option>
                                                    <option value="1">01:00</option>
                                                    <option value="2">02:00</option>
                                                    <option value="3">03:00</option>
                                                    <option value="4">04:00</option>
                                                    <option value="5">05:00</option>
                                                    <option value="6">06:00</option>
                                                    <option value="7">07:00</option>
                                                    <option value="8">08:00</option>
                                                    <option value="9" selected="">09:00</option>
                                                    <option value="10">10:00</option>
                                                    <option value="11">11:00</option>
                                                    <option value="12">12:00</option>
                                                    <option value="13">13:00</option>
                                                    <option value="14">14:00</option>
                                                    <option value="15">15:00</option>
                                                    <option value="16">16:00</option>
                                                    <option value="17">17:00</option>
                                                    <option value="18">18:00</option>
                                                    <option value="19">19:00</option>
                                                    <option value="20">20:00</option>
                                                    <option value="21">21:00</option>
                                                    <option value="22">22:00</option>
                                                    <option value="23">23:00</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="shed_pat_time_end" id="shed_pat_time_end_id"
                                                        class="form-control">
                                                    <option value="1">01:00</option>
                                                    <option value="2">02:00</option>
                                                    <option value="3">03:00</option>
                                                    <option value="4">04:00</option>
                                                    <option value="5">05:00</option>
                                                    <option value="6">06:00</option>
                                                    <option value="7">07:00</option>
                                                    <option value="8">08:00</option>
                                                    <option value="9">09:00</option>
                                                    <option value="10">10:00</option>
                                                    <option value="11">11:00</option>
                                                    <option value="12">12:00</option>
                                                    <option value="13">13:00</option>
                                                    <option value="14">14:00</option>
                                                    <option value="15">15:00</option>
                                                    <option value="16">16:00</option>
                                                    <option value="17">17:00</option>
                                                    <option value="18">18:00</option>
                                                    <option value="19">19:00</option>
                                                    <option value="20" selected="">20:00</option>
                                                    <option value="21">21:00</option>
                                                    <option value="22">22:00</option>
                                                    <option value="23">23:00</option>
                                                    <option value="24">24:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Выставить на</label>

                                            <div class="col-sm-4">
                                                <select name="shed_pat_week_count" class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>

                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 p-xxs">
                                                недель вперед
                                            </div>
                                        </div>
                                        <br>
                                        <a class="newService">Заполнить и сохранить график</a>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

</div>

<?php $this->endBody() ?>
<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/lang/ru.js"></script>
<script src="/js/schedule.js"></script>

<script src="/js/payment.js"></script>
<script src="/js/index.js"></script>
<script src="/js/main.js"></script>
<script src="/js/sms.js"></script>
<script src="/js/master.js"></script>
<script src="/js/mask.js"></script>
<script src="/js/scroll.js"></script>

</body>
</html>
<?php $this->endPage() ?>
