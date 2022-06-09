<?php $data = forecast_weather(); ?>

<style>
    #app {
        display: grid;
        background: #313131;
        grid-template-columns: 100% 100% 100%;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
    }

    #d1 {
        background: white no-repeat;
        background-size: cover;
        position: relative;
    }

    #d2 {
        position: relative;
        background: #2196F3;
    }

    #d3 {
        background: #263238;
        position: relative;
    }

    .icon {
        width: 250px;
        height: 200px;
        box-sizing: border-box;
        padding-top: 50px;
        display: flex;
        justify-content: center;
    }

    .description {
        width: 100%;
        padding-top: 10px;
        text-align: center;
        color: white;
    }

    .title {
        display: inline-block;
        color: white;
        padding: 10px;
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .temp {
        padding-top: 10px;
        text-align: center;
        color: white;
        font-size: 24px;
    }

    .next {
        font-size: 14px;
        color: white;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        width: 80%;
        margin: auto;
        border-bottom: 1px solid rgb(200, 200, 200);
    }

    .list {
        padding-top: 15px;
        color: white;
        display: flex;
        justify-content: space-around;
    }

    .weekday {
        font-size: 12px;
    }

    .wicon {
        padding-top: 5px;
        text-align: center;
    }

    .wicon img {
        width: 36px;
    }

    .wtemp {
        text-align: center;
        font-size: 12px;
    }

    .cities {
        background: #252525;
        color: white;
        position: fixed;
        top: 10px;
        left: 10px;
        font-size: 14px;
        cursor: pointer;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
    }

    .city {
        box-sizing: border-box;
        padding-left: 10px;
        width: 150px;
        height: 30px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .city:hover {
        background: #0986f3;
    }

    .active_city {
        background: #2196F3;
    }
</style>
<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-dark mt-4">
    <div class="d-flex align-items-center flex-shrink-0 p-3 link-white text-decoration-none">
        <svg class="bi me-2" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-5 fw-semibold">Thời tiết Hà Nội hôm nay</span>
    </div>
    <div class="list-group list-group-flush scrollarea overflow-auto">
        <div id="app">
            <div id="d2">
                <?php foreach ($data['day'] as $key => $value) :
                    if ($key == 0) : ?>
                        <div class="title">
                            Ngày
                        </div>
                        <div class="icon"><img src="<?php echo $value['Icon']; ?>" alt=""></div>
                        <div class="description">
                            <?php echo $value['IconPhrase']; ?>
                        </div>
                        <div class="temp">
                            <?php echo $value['Temp']; ?> °C
                        </div>
                        <div class="next"></div>
                        <div class="list">
                            <!---->
                        <?php else : ?>
                            <div class="wday">
                                <div class="weekday"><?php echo $value['Date']; ?></div>
                                <div class="wicon"><img src="<?php echo $value['Icon']; ?>"></div>
                                <div class="wtemp"><?php echo $value['Temp']; ?> °C</div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                        </div>
            </div>
            <div id="d3">
                <?php foreach ($data['night'] as $key => $value) :
                    if ($key == 0) : ?>
                        <div class="title">
                            Đêm
                        </div>
                        <div class="icon"><img src="<?php echo $value['Icon']; ?>" alt=""></div>
                        <div class="description">
                            <?php echo $value['IconPhrase']; ?>
                        </div>
                        <div class="temp">
                            <?php echo $value['Temp']; ?> °C
                        </div>
                        <div class="next"></div>
                        <div class="list">
                            <!---->
                        <?php else : ?>
                            <div class="wday">
                                <div class="weekday"><?php echo $value['Date']; ?></div>
                                <div class="wicon"><img src="<?php echo $value['Icon']; ?>"></div>
                                <div class="wtemp"><?php echo $value['Temp']; ?> °C</div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                        </div>
            </div>
        </div>
    </div>
</div>