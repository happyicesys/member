/* empty css                                                                        */import{_ as M}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{o as u,h as m,f as z,A as j,l as w,r as C,b as s,C as p,g as k,Q as L,a,w as o,n as v,I as B,c as A,u as b,k as x,W as S,d as r,t as y,j as V,X as D}from"./app-D_YVD_nw.js";import{_ as f}from"./ResponsiveNavLink-B1STzUec.js";const U={src:"/images/logo_1.png",alt:"Logo",class:"h-auto w-auto max-h-18 mx-auto"},E={__name:"ApplicationLogo",setup(l){return(i,n)=>(u(),m("img",U))}},N=M(E,[["__scopeId","data-v-22f002e9"]]),P={class:"relative"},T={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:String,default:"py-1 bg-white"}},setup(l){const i=l,n=d=>{e.value&&d.key==="Escape"&&(e.value=!1)};z(()=>document.addEventListener("keydown",n)),j(()=>document.removeEventListener("keydown",n));const h=w(()=>({48:"w-48"})[i.width.toString()]),t=w(()=>i.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":i.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top"),e=C(!1);return(d,c)=>(u(),m("div",P,[s("div",{onClick:c[0]||(c[0]=_=>e.value=!e.value)},[p(d.$slots,"trigger")]),k(s("div",{class:"fixed inset-0 z-40",onClick:c[1]||(c[1]=_=>e.value=!1)},null,512),[[L,e.value]]),a(B,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"opacity-0 scale-95","enter-to-class":"opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"opacity-100 scale-100","leave-to-class":"opacity-0 scale-95"},{default:o(()=>[k(s("div",{class:v(["absolute z-50 mt-2 rounded-md shadow-lg",[h.value,t.value]]),style:{display:"none"},onClick:c[2]||(c[2]=_=>e.value=!1)},[s("div",{class:v(["rounded-md ring-1 ring-black ring-opacity-5",l.contentClasses])},[p(d.$slots,"content")],2)],2),[[L,e.value]])]),_:3})]))}},$={__name:"DropdownLink",props:{href:{type:String,required:!0}},setup(l){return(i,n)=>(u(),A(b(x),{href:l.href,class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"},{default:o(()=>[p(i.$slots,"default")]),_:3},8,["href"]))}},g={__name:"NavLink",props:{href:{type:String,required:!0},active:{type:Boolean}},setup(l){const i=l,n=w(()=>i.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(h,t)=>(u(),A(b(x),{href:l.href,class:v(n.value)},{default:o(()=>[p(h.$slots,"default")]),_:3},8,["href","class"]))}},I={class:"min-h-screen flex flex-col bg-gray-100"},O={class:"border-b border-gray-100 bg-white"},q={class:"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"},J={class:"flex justify-between h-16 items-center"},Q={class:"flex items-center"},F={class:"hidden sm:flex space-x-8 items-center"},H={class:"flex items-center"},W={class:"hidden sm:flex sm:items-center"},X={class:"inline-flex rounded-md"},G={type:"button",class:"inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700"},K={class:"-me-2 flex sm:hidden"},R={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},Y={class:"space-y-1 pb-3 pt-2"},Z={class:"border-t border-gray-200 pb-1 pt-4"},ee={class:"px-4"},te={class:"text-base font-medium text-gray-800"},se={class:"text-sm font-medium text-gray-500"},oe={class:"mt-3 space-y-1"},ae={key:0,class:"bg-white shadow"},re={class:"mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"},ne={class:"text-center pt-5 pb-10 bg-gray-50"},ie={class:"flex justify-center space-x-5"},le={__name:"AuthenticatedLayout",setup(l){C(!1);const i=S();w(()=>{var t,e,d;return((d=(e=(t=i.value)==null?void 0:t.props)==null?void 0:e.route)==null?void 0:d.name)||""});const n=C(!1);function h(){n.value=!n.value}return(t,e)=>(u(),m("div",I,[s("nav",O,[s("div",q,[s("div",J,[s("div",Q,[a(b(x),{href:t.route("dashboard")},{default:o(()=>[a(N,{class:"max-w-16 max-h-10"})]),_:1},8,["href"])]),s("div",F,[a(g,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:o(()=>e[0]||(e[0]=[r(" Dashboard ")])),_:1},8,["href","active"]),a(g,{href:t.route("profile.edit"),active:t.route().current("profile.edit")},{default:o(()=>e[1]||(e[1]=[r(" Profile ")])),_:1},8,["href","active"]),a(g,{href:t.route("about"),active:t.route().current("about")},{default:o(()=>e[2]||(e[2]=[r(" About Us ")])),_:1},8,["href","active"]),a(g,{href:t.route("contact-us"),active:t.route().current("contact-us")},{default:o(()=>e[3]||(e[3]=[r(" Contact Us ")])),_:1},8,["href","active"]),a(g,{href:t.route("join-licensee"),active:t.route().current("join-licensee")},{default:o(()=>e[4]||(e[4]=[r(" Join Us as Licensee ")])),_:1},8,["href","active"])]),s("div",H,[s("div",W,[a(T,{align:"right",width:"48"},{trigger:o(()=>[s("span",X,[s("button",G,[r(y(t.$page.props.auth.user.name)+" ",1),e[5]||(e[5]=s("svg",{class:"ms-2 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[s("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1))])])]),content:o(()=>[a($,{href:t.route("profile.edit")},{default:o(()=>e[6]||(e[6]=[r("Profile")])),_:1},8,["href"]),a($,{href:t.route("logout"),method:"post",as:"button"},{default:o(()=>e[7]||(e[7]=[r("Log Out")])),_:1},8,["href"])]),_:1})]),s("div",K,[s("button",{onClick:h,class:"rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500"},[(u(),m("svg",R,[s("path",{class:v({hidden:n.value,"inline-flex":!n.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),s("path",{class:v({hidden:!n.value,"inline-flex":n.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])])]),s("div",{class:v([{block:n.value,hidden:!n.value},"sm:hidden"])},[s("div",Y,[a(f,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:o(()=>e[8]||(e[8]=[r("Dashboard")])),_:1},8,["href","active"]),a(f,{href:t.route("profile.edit"),active:t.route().current("profile.edit")},{default:o(()=>e[9]||(e[9]=[r("Profile")])),_:1},8,["href","active"]),a(f,{href:t.route("about"),active:t.route().current("about")},{default:o(()=>e[10]||(e[10]=[r("About Us")])),_:1},8,["href","active"]),a(f,{href:t.route("contact-us"),active:t.route().current("contact-us")},{default:o(()=>e[11]||(e[11]=[r("Contact Us")])),_:1},8,["href","active"]),a(f,{href:t.route("join-licensee"),active:t.route().current("join-licensee")},{default:o(()=>e[12]||(e[12]=[r("Join Us as Licensee")])),_:1},8,["href","active"])]),s("div",Z,[s("div",ee,[s("div",te,y(t.$page.props.auth.user.name),1),s("div",se,y(t.$page.props.auth.user.email),1)]),s("div",oe,[a(f,{href:t.route("logout"),method:"post",as:"button"},{default:o(()=>e[13]||(e[13]=[r("Log Out")])),_:1},8,["href"])])])],2)]),t.$slots.header?(u(),m("header",ae,[s("div",re,[p(t.$slots,"header",{},void 0,!0)])])):V("",!0),s("main",null,[p(t.$slots,"default",{},void 0,!0)]),s("footer",ne,[e[16]||(e[16]=D('<section class="flex flex-col items-center py-8" data-v-cb62639c><div class="text-center text-gray-600 text-2xl font-semibold tracking-wide" data-v-cb62639c>Follow Us</div><div class="flex justify-between space-x-2 mt-4" data-v-cb62639c><a href="https://www.facebook.com/dcvendsg" target="_blank" data-v-cb62639c><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" data-v-cb62639c><path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z" data-v-cb62639c></path></svg></a><a href="https://www.instagram.com/dcvendsg/" target="_blank" data-v-cb62639c><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" data-v-cb62639c><path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z" data-v-cb62639c></path></svg></a><a href="https://www.tiktok.com/@dcvendsg" target="_blank" data-v-cb62639c><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" data-v-cb62639c><path d="M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z M37.006,22.323 c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527 s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053 c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016 c0.378,3.591,3.277,6.425,6.901,6.685V22.323z" data-v-cb62639c></path></svg></a></div></section><p class="text-sm text-gray-500" data-v-cb62639c>© 2024 DCVIC PTE. LTD. All rights reserved.</p>',2)),s("div",ie,[a(b(x),{href:"/terms-and-conditions",class:"text-sm text-gray-500 hover:text-blue-600"},{default:o(()=>e[14]||(e[14]=[r("Terms and Conditions")])),_:1}),a(b(x),{href:"/privacy-policy",class:"text-sm text-gray-500 hover:text-blue-600"},{default:o(()=>e[15]||(e[15]=[r("Privacy Policy")])),_:1})])])]))}},ve=M(le,[["__scopeId","data-v-cb62639c"]]);export{ve as A};
