

var app = new Vue({
  
  el:'#app',
  
  data: {

      selectGoal: '',
      selectFoot: '',
      selectFeeling: '',
      deck_inch: '',

  },

  methods : {


    // ハンバーガーボタン押した時ここから
    hamburgerPush(){
      const bar_1 = document.getElementById('bar1')
      const bar_2 = document.getElementById('bar2')
      const bar_3 = document.getElementById('bar3')
      const ham_nav = document.getElementById('ham-nav')

      if( bar_1.classList.contains('rotate-45') != true){//ハンバーガー
        
        bar_1.classList.add('rotate-45','translate-x-2','translate-y-3','bg-white','duration-300')
        bar_2.classList.add('opacity-0','duration-300')
        bar_3.classList.add('-rotate-45','translate-x-2','-translate-y-3','bg-white','duration-300')

        ham_nav.classList.remove('invisible')
        

      }else if( bar_1.classList.contains('rotate-45') == true ){//バツ
      
        
        bar_1.classList.remove('rotate-45','translate-x-2','translate-y-3','bg-white')
        bar_2.classList.remove('opacity-0')
        bar_3.classList.remove('-rotate-45','translate-x-2','-translate-y-3','bg-white')

        ham_nav.classList.add('invisible')
      }



    },
    // ハンバーガーボタン押した時ここまで

    //ハンバーガーメニューのナビ項目押した時ここから

    hamburgerNavPush(){

      const bar_1 = document.getElementById('bar1')
      const bar_2 = document.getElementById('bar2')
      const bar_3 = document.getElementById('bar3')
      const ham_nav = document.getElementById('ham-nav')
      
      ham_nav.classList.add('invisible')

      bar_1.classList.remove('rotate-45','translate-x-2','translate-y-3','bg-white')
      bar_2.classList.remove('opacity-0')
      bar_3.classList.remove('-rotate-45','translate-x-2','-translate-y-3','bg-white')

      ham_nav.classList.add('invisible')

    },

    //ハンバーガーメニューのナビ項目押した時ここまで
    
    
    
    // クリエイトボタン押した時ここから
    setParts(){

      if(this.selectGoal == '' || this.selectFoot == '' || this.selectFeeling == ''){
        alert('全て選択してください！')
      }else{
        const goal = {
          
          data: this.selectGoal,
  
          // ストリートページオープンここから
          
          select: function(){
            if(goal.data === 'goal-1'){
              const street = document.getElementById('street-wrapper')
              street.classList.remove('hidden')
            }          
            
            // ストリートページオープンここから
            
            // オープンしたページへスクロールここから
            
            const element = document.getElementById('street-wrapper')
            const rect = element.getBoundingClientRect()
            const elemtop = rect.top + window.pageYOffset
            document.documentElement.scrollTop = elemtop
  
  
            // オープンしたページへスクロールここから
            
          }
  
  
        }
        const foot ={
  
          data: this.selectFoot,
          
          deck_data: this.deck_inch,
          
          select: function(){
  
            
            if(foot.data === 'foot-under-18'){
              
              // this.deck_inch = '幅：6.875インチ'
              document.getElementById("deck-inch").textContent= "幅：6.875インチ"
  
            }else if(foot.data === 'foot-19'){
  
              document.getElementById("deck-inch").textContent= "幅：7.25インチ"
              
            }else if(foot.data === 'foot-20'){
  
              document.getElementById("deck-inch").textContent= "幅：7.25インチ"
    
            }else if(foot.data === 'foot-21'){
  
              document.getElementById("deck-inch").textContent= "幅：7.25~7.5インチ"
              
            }else if(foot.data === 'foot-22'){
  
              document.getElementById("deck-inch").textContent= "幅：7.25~7.5インチ"
              
            }else if(foot.data === 'foot-23'){
  
              document.getElementById("deck-inch").textContent= "幅：7.5~7.75インチ"
              
            }else if(foot.data === 'foot-24'){
  
              document.getElementById("deck-inch").textContent= "幅：7.5~7.875インチ"
              
            }else if(foot.data === 'foot-25'){
  
              document.getElementById("deck-inch").textContent= "幅：7.625~8.0インチ"
              
            }else if(foot.data === 'foot-26'){
  
              document.getElementById("deck-inch").textContent= "幅：7.75~8.25インチ"
              
            }else if(foot.data === 'foot-27'){
              
              document.getElementById("deck-inch").textContent= "幅：8.0~8.5インチ"
  
            }else if(foot.data === 'foot-28'){
  
              document.getElementById("deck-inch").textContent= "幅：8.0~8.5インチ"
              
            }else if(foot.data === 'foot-29'){
  
              document.getElementById("deck-inch").textContent= "幅：8.25~8.75インチ"
              
            }else if(foot.data === 'foot-30'){
  
              document.getElementById("deck-inch").textContent= "幅：8.375~8.75インチ"
              
            }
  
            
          }
  
        }
        const feeling ={
  
          data: this.selectFeeling,
  
          select: function(){
            
            if(feeling.data === 'casual'){
  
              document.getElementById('brand').textContent = "ブランド：INDEPENDENT"
              
              document.getElementById('height').textContent = "高さ：ハイ"
  
              document.getElementById('wheel-size').textContent = "大きさ：50mm~52mm"
          
            }else if(feeling.data === 'normal'){
  
              document.getElementById('brand').textContent = "ブランド：THUNDER"
              
              document.getElementById('height').textContent = "高さ：ロー"
  
              document.getElementById('wheel-size').textContent = "大きさ：53mm~55mm"
  
            }else if(feeling.data === 'stable'){
  
              document.getElementById('brand').textContent = "ブランド：VENTURE"
  
              document.getElementById('height').textContent = "高さ：ロー"
              
              document.getElementById('wheel-size').textContent = "大きさ：53mm~55mm"
  
            }
  
          }
  
        }
        
        
        goal.select()
        foot.select()
        feeling.select()
      }

    },
    // クリエイトボタン押した時ここまで

    contactSend(){

      alert('お問い合わせありがとうございます！引き続きよろしくお願いします！')

    }
  }

})



// その他js

window.addEventListener('DOMContentLoaded', function(){
  
  // ページ内スクロール移動ここから

  const anchorLinks = document.querySelectorAll('a[href^="#"]')
  const anchorLinksArr = Array.prototype.slice.call(anchorLinks)

  anchorLinksArr.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault()
      const targetId = link.hash;
      const targetElement = document.querySelector(targetId);
      const targetOffsetTop = window.pageYOffset + targetElement.getBoundingClientRect().top;
      window.scrollTo({
        top: targetOffsetTop,
        behavior: "smooth"
      })
    })
  })

  // ページ内スクロール移動ここまで




});

  // その他js