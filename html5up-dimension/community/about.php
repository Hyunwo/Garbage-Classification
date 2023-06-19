<?php include('navbar.html'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Garbage-Helper</title>
    <link rel="stylesheet" type="text/css" href="about.css">
</head>
<body>
    
    <section id="about">
        <h2>Garbage-Helper</h2>
        <p>Garbage-Helper는 '환경 보호를 위해 올바른 분리수거를 할 수 있도록' 하고자 제작된 프로젝트입니다.</p>
        <p>환경보호를 위한 올바른 분리수거에 대한 인식을 높이는 것이 Garage-Helper의 목표입니다.</p>
        <p>분리수거하는 방법을 궁금해 하는 사용자가 사진을 올리면 자동으로 사진을 분류해 분리수거 방법을 제공합니다.</p>
    </section>
    
    <section id="services" style="display: flex; align-items: center;">
        <div style="flex: 1;">
            <h2>Services</h2>
            <p>검색을 통해 분리수거 방법 찾기 (Search for Recycling)</p>
            <p>이미지 삽입을 통해 분리수거 방법 찾기 (Insert image for Recycling)</p>
            <p>자유게시판을 통해 사람들과 의견을 나눠 분리수거 방법 찾기 (Sharing opnion for Recycling)</p>
        </div>
        <div style="flex: 1; text-align: right;">
            <img src="/images/about1.jpg" alt="Join us" style="max-width: 100%; height: auto;">
        </div>
    </section>


    <section id="vision" style="display: flex; align-items: center;">
        <div style="flex: 1; text-align: right; margin-right: 20px;">
            <img src="/images/about2.jpg" alt="Join us" style="max-width: 100%; height: auto;">
        </div>
        <div style="flex: 1;">
            <h2>Vision</h2>
            <p>효율적이고 정확한 분리수거를 통해 사회경제적인 이익과 환경의 보전을 추구합니다.</p>
            <p>분리수거를 통해 환경 보호에 동참하는 모두의 노력과 협력으로 지속 가능한 환경을 구축하는 것입니다.</p>
            <p>환경을 위한 올바른 분리수거 문화를 조성하여 지속 가능한 미래를 향해 나아가는 사회를 만들고자 합니다.</p>
        </div>
    </section>


    
    <section id="contact" style="display: flex; align-items: center;">
        <div style="flex: 1;">
            <h2>Join Us</h2>
                <p>환경보호는 우리 모두의 책임입니다. 작은 실천이 모여 큰 변화를 이룰 수 있습니다.</p>
                <p>우리가 함께 올바른 분리수거를 실천하면서 환경을 보호해 나가 봅시다.</p>
                <p>환경을 사랑하고 지키는 마음으로, 우리의 작은 일들이 지구를 위한 큰 선물이 되기를 기대합니다.</p>
        </div>
        <div style="flex: 1; text-align: right;">
            <img src="/images/about3.jpg" alt="Join us" style="max-width: 100%; height: auto;">
        </div>
        <style>
            @media (max-width: 768px) {
                .flex-container {
                    flex-direction: column;
                }
                .text-container {
                    text-align: center;
                }
                .flex-container > div {
                    margin-top: 20px;
                }
            }
        </style>
    </section>

    <section id="portfolio">
    <h2>Developer</h2>
    <div class="portfolio-container">
        <div class="portfolio-item">
            <div class="profile-img">
                <img src="/images/jaek.jpg" alt="Profile 1">
            </div>
            <h3>김재겸</h3>
            <p>2019475019 역사문화콘텐츠학부</p>
        </div>
        <div class="portfolio-item">
            <div class="profile-img">
                <img src="/images/kub.jpg" alt="Profile 2">
            </div>
            <h3>구보회</h3>
            <p>2019243089 컴퓨터공학부</p>
        </div>
        <div class="portfolio-item">
            <div class="profile-img">
                <img src="/images/hyeonu.jpg" alt="Profile 3">
            </div>
            <h3>정현우</h3>
            <p>2019225189 컴퓨터공학부</p>
        </div>
    </div>
    <style>
        .portfolio-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .portfolio-item {
            width: 30%;
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 10px;
        }
        .profile-img img {
            max-width: 100%;
            height: auto;
        }
        @media (max-width: 768px) {
            .portfolio-item {
                width: 45%;
            }
        }
        @media (max-width: 480px) {
            .portfolio-item {
                width: 100%;
            }
        }
    </style>
</section>


    <footer>
        <p>&copy; 2023 Team3 Garbage-Helper. All Rights Reserved</p>
    </footer>
</body>
</html>
