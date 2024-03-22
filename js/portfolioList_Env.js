fetch('portfolioList_Env.php')
    .then(response => response.json())
    .then(data => {
        // data.ImageRoute를 콘솔에 출력
        console.log(data.ImageRoute);

        // data.ImageRoute는 이미 배열이므로 분리할 필요 없음
        var filenames = data.ImageRoute; 

        // 각 파일에 대해 <img> 태그 생성 및 <div>로 감싸기
        var divEnv = document.getElementById('divEnv');
        for (var i = 0; i < filenames.length; i++) {
            var img = document.createElement('img');
            img.src = './data/portfolio/' + filenames[i];
            img.className = 'hover:scale-105 objectfit-cover duration-300';  // 이미지 파일의 경로를 설정해야 합니다.
            
            var div = document.createElement('div');
            div.id = 'portfolioItem' + (i+1);
            div.className ='w-full h-full flex justify-center items-center objectfit-cover overflow-hidden cursor-pointer';
            div.appendChild(img);
            
            divEnv.appendChild(div);
        }
    })
    .catch(error => console.error('Error:', error));   
