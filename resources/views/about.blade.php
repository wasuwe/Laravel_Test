<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">

        <style>
            body { max-width: 1350px; margin: auto; background: #eee; font-family: 'Prompt', serif; }
            .section1 {
                display: flex;
                width: 750px;
                margin: auto;
                border-radius: 10px;
                overflow: hidden;
                height: 350px;                
                box-shadow: rgb(0 0 0 / 15%) 1.95px 1.95px 2.6px;
            }
            .sectionleft {
                width: 100%;
                transition: all 1s;
            }
            .sectionleft img {
                width: 100%; 
                height: 100%;
                object-fit: cover;
            }
            .sectionrigth {
                width: 0;
                opacity: 0;
                padding: 0;
                transition: all 1s;
                box-sizing: border-box;
            }
            .sectionrigth .title {
                font-size: 20px;
                margin-bottom: 10px;
                border-bottom: 1px solid #b2b2b2;
                padding-bottom: 10px;
            }
            .sectionrigth .detail {
                font-size: 16px;
                display: -webkit-box;
                -webkit-line-clamp: 7;
                -webkit-box-orient: vertical;
                overflow: hidden;
                margin-bottom: 10px;
            }
            .sectionrigth .btn {
                margin-top: 5px;
                display: block;
                color: #ffffff;
                background: #4FBDBA;
                width: 100px;
                text-align: center;
                padding: 5px 15px;
                border-radius: 5px;
                box-shadow: rgb(0 0 0 / 15%) 1.95px 1.95px 2.6px;
                cursor: pointer;
            }
            
            .section1:hover .sectionleft {
                width: 50%;
            }
            .section1:hover .sectionrigth {
                width: 50%;
                padding: 10px 20px;    
                opacity: 1;
                transition-delay: 0.5s
            }
            
        </style>

    </head>

    <body>
        <div class="section1">
            <div class="sectionleft">
                <img src="https://image.freepik.com/free-photo/woman-with-pink-hair-playing-videogame_23-2148969220.jpg" alt="">
            </div>
            <div class="sectionrigth">
                <div class="title">เสาร์-อาทิตย์นี้ เล่นเกมอะไรดี : Ready or Not จุดไฟครั้งใหม่ให้กับเกมแนว Tactical Shooter</div>
                <div class="detail">24 ธันวาคม 2021 – หลังจากเล่นเกมยิงมาเยอะมากในช่วงปีนี้ที่ผ่านมา ผู้เขียนถึงเพิ่งสังเกตได้ว่า ส่วนใหญ่แล้วเกมยิงที่เปิดตัวในปีนี้ มีน้อยเกมมากที่จะเป็นแนว Hardcore หรือแบบ Tactical ที่เข้าขั้น Realism นอกจาก Rainbow Six ที่ยืนหนึ่งมาก่อน แต่แฟนเกมน่าจะเห็นแล้วว่ามันก็ไม่ได้ยากอะไรขนาดนั้น จนกระทั่งเมื่อช่วงกลางเดือนธันวาคมที่ผ่านมา การประกาศวางจำหน่ายแบบสายฟ้าแลบ แม้จะเป็นในรูปแบบ Early Access ของเกมที่ชื่อ Ready or Not จึงกลายเป็นกระแสขึ้นมาชั่วข้ามคืน แถมตัวเกมยังยอดเยี่ยมจริง ๆ เสียด้วย สัปดาห์นี้ผู้เขียนจึงขอหยิบเอาเกมนี้มาเล่าให้ฟังว่ามันเป็นยังไง</div>
                <a class="btn" title="Link" href="https://www.gamingdose.com/feature/%e0%b9%80%e0%b8%aa%e0%b8%b2%e0%b8%a3%e0%b9%8c-%e0%b8%ad%e0%b8%b2%e0%b8%97%e0%b8%b4%e0%b8%95%e0%b8%a2%e0%b9%8c%e0%b8%99%e0%b8%b5%e0%b9%89-%e0%b9%80%e0%b8%a5%e0%b9%88%e0%b8%99%e0%b9%80%e0%b8%81-6/" target="_blank" rel="noopener noreferrer">
                    ดูเพิ่มเติม
                </a>
            </div>
        </div>

        
    </body>
    
</html>
