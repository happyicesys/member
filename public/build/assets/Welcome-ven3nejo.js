import{G as p}from"./GuestLayout-D40vGowr.js";import{f as g,c as f,w as d,o as b,a as m,u as c,Z as y,b as t,t as x,d as l,k as w}from"./app-CBXUB5r7.js";import{_ as h}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ResponsiveNavLink-DqR3-Q8U.js";const v={class:"bg-white py-8 px-4"},D={class:"flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-4 md:gap-8 md:w-2/5 text-center mx-auto"},k={class:"bg-yellow-300 py-3 md:py-6 px-14 rounded-lg shadow-md"},M={class:"text-xl md:text-2xl font-bold text-gray-600 flex flex-col items-center space-y-2"},E={class:"text-3xl md:text-5xl font-extrabold drop-shadow-sm"},C={class:"bg-yellow-300 py-3 md:py-6 px-10 rounded-lg shadow-md hidden"},V={class:"text-xl md:text-2xl font-bold text-gray-600 flex flex-col items-center space-y-2"},S={class:"text-3xl md:text-5xl font-extrabold drop-shadow-sm"},_={class:"bg-white py-8 px-6"},F={class:"flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-8 md:w-2/5 text-center mx-auto"},G={__name:"Welcome",props:{dcVends:[Array,Object],mapApiKey:String,stats:[Array,Object]},setup(n){const a=n;let s;g(()=>{console.log("DCVend:",a.dcVends),u()});function u(){const o=document.createElement("script");o.src=`https://maps.googleapis.com/maps/api/js?key=${a.mapApiKey}&callback=initMap&libraries=places`,o.async=!0,o.defer=!0,document.head.appendChild(o)}window.initMap=function(){new google.maps.DirectionsService,navigator.geolocation?navigator.geolocation.getCurrentPosition(o=>{const e={lat:o.coords.latitude,lng:o.coords.longitude};s=new google.maps.Map(document.getElementById("map"),{center:e,zoom:12}),i(),new google.maps.Marker({position:e,map:s,label:"You"})},o=>{console.error("Error getting user location:",o),r()}):(console.error("Geolocation is not supported by this browser."),r())};function r(){const o={lat:3.139,lng:101.6869};s=new google.maps.Map(document.getElementById("map"),{center:o,zoom:12}),i()}function i(){[{lat:3.139,lng:101.6869,label:"A"},{lat:3.141,lng:101.689,label:"B"}].forEach(e=>{new google.maps.Marker({position:{lat:e.lat,lng:e.lng},map:s,label:e.label})})}return(o,e)=>(b(),f(p,null,{default:d(()=>[m(c(y),{title:"DCVend Membership"}),e[6]||(e[6]=t("section",{class:"text-white rounded my-2 px-2"},[t("img",{src:"/images/banner_3.jpg",alt:"DCVend Banner",class:"w-full rounded hidden md:block"}),t("img",{src:"/images/banner_mobile_3.jpg",alt:"DCVend Banner Mobile",class:"w-full rounded md:hidden"})],-1)),t("section",v,[e[2]||(e[2]=t("div",{class:"text-center text-red-600 text-3xl font-semibold tracking-wide"},[t("div",{class:"md:w-1/2 mx-auto"}," Enjoy premium ice cream at 30% discount with a DCVend membership ")],-1)),t("div",D,[t("div",k,[t("p",M,[t("span",E,x(n.stats.users.toLocaleString(void 0,{minimumFractionDigits:0,maximumFractionDigits:0})),1),e[0]||(e[0]=t("span",null," Members ",-1))])]),t("div",C,[t("p",V,[t("span",S," S$ "+x(n.stats.discount.toLocaleString(void 0,{minimumFractionDigits:2,maximumFractionDigits:2})),1),e[1]||(e[1]=t("span",null," Discount Given ",-1))])])]),e[3]||(e[3]=t("div",{class:"text-right text-gray-600 text-md mt-2"},[t("div",{class:"md:w-1/5 mx-auto"}," updated daily ")],-1))]),e[7]||(e[7]=t("section",{class:"pb-6 pt-2 md:pt-6 bg-white px-6"},[t("div",{class:"container mx-auto max-w-4xl text-center"},[t("h2",{class:"text-3xl font-bold text-red-600 mb-6"},"Why Join DCVend?"),t("ul",{class:"text-gray-600 space-y-1 text-left md:text-center"},[t("li",null,[t("strong",null,"Discount & Convenient:"),l(" Enjoy 30% off premium ice cream, 24/7 ")]),t("li",null,[t("strong",null,"Free membership:"),l(" Start saving today! Upgrade to VIP for exclusive perks. ")]),t("li",null,[t("strong",null,"Exclusive Perks:"),l(" Unlock special products and offers from our partners. ")]),t("li",null,[t("strong",null,"Instant Delivery:"),l(" Order via Grab and get 8% cashback. ")]),t("li",null,[t("strong",null,"Crazy After-Meal Deals:"),l(" Incredible savings on a rotating selection of flavours. ")])])])],-1)),e[8]||(e[8]=t("section",{class:"py-6 md:py-12 bg-gray-50 rounded px-6"},[t("div",{class:"container mx-auto max-w-6xl text-center"},[t("h2",{class:"text-3xl font-bold text-red-600 mb-8"},"Membership Plans"),t("div",{class:"grid grid-cols-1 md:grid-cols-3 gap-6"},[t("div",{class:"bg-slate-200 rounded-md shadow-md p-6 text-center"},[t("h3",{class:"text-4xl font-bold text-gray-600 font-extrabold mb-4"},"FREE Member"),t("ul",{class:"text-gray-600 mb-4 space-y-2"},[t("li",null,[t("strong",null,"1 time: "),l(" 30% discount on all products")])]),t("p",{class:"text-xl font-bold text-gray-600"},"FREE/ month")]),t("div",{class:"bg-slate-200 rounded-md shadow-md p-6 text-center"},[t("h3",{class:"text-4xl font-bold text-gray-600 font-extrabold mb-4"},"Gold Member"),t("ul",{class:"text-gray-600 mb-4 space-y-2"},[t("li",null,[t("strong",null,"4 times:"),l(" 30% discount on all products")])]),t("p",{class:"text-xl font-bold text-gray-600"},"S$ 2.90/ month")]),t("div",{class:"bg-slate-300 rounded-md shadow-md p-6 text-center"},[t("h3",{class:"text-4xl font-bold text-gray-600 font-extrabold mb-4"},[l(" Platinum Member "),t("small",{class:"text-sm text-red-600"},"(Coming soon)")]),t("ul",{class:"text-gray-500 mb-4 space-y-2"},[t("li",null,[t("strong",null,"Unlimited:"),l(" 30% discount on all products")]),t("li",null,[t("strong",null,"FREE:"),l(" S$2 voucher")]),t("li",null,[t("strong",null,"Unlimited:"),l(" Crazy after-meal deals")]),t("li",null,[t("strong",null,"Unlimited:"),l(" 8% cashback on orders via Grab")]),t("li",null,[t("strong",null,"Unlimited:"),l(" 8% discount from affiliated vending machines")])]),t("p",{class:"text-xl font-bold text-gray-600"},"S$ 5.00/ month")])])])],-1)),t("section",_,[e[5]||(e[5]=t("div",{class:"text-center text-gray-600 text-2xl font-semibold tracking-wide md:w-3/5 mx-auto"},[t("strong",null,"New Sign-up:"),l(" Free Gold Member package, with FREE upgrade to unlimited times of 30% discount on all products, for 2 months ")],-1)),t("div",F,[m(c(w),{href:o.route("register"),class:"bg-yellow-300 py-4 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400"},{default:d(()=>e[4]||(e[4]=[l(" SIGN UP NOW ")])),_:1},8,["href"])])]),e[9]||(e[9]=t("section",{class:"pb-6 pt-4 md:pt-8 bg-white"},[t("div",{class:"container mx-auto max-w-4xl text-center"},[t("h2",{class:"text-3xl font-bold text-red-600 mb-6"},"DCVend Location")]),t("div",{id:"map",class:"sm:col-span-6 mb-3 items-center mx-auto w-11/12 md:w-9/12 h-96"})],-1))]),_:1}))}},P=h(G,[["__scopeId","data-v-9a5f7530"]]);export{P as default};
