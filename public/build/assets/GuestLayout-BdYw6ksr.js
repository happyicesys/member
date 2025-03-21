import{r as h,X as m,l as x,o as g,h as p,b as r,a as o,w as s,u as a,i as l,d as n,n as d,g as k,Q as C,I as U,C as j}from"./app-BcHql35j.js";import{_ as u}from"./ResponsiveNavLink-BmRDeMEw.js";import{_ as D}from"./_plugin-vue_export-helper-DlAUqK2U.js";const M={class:"min-h-screen flex flex-col bg-gray-100"},L={class:"flex justify-between items-center px-4 py-4 bg-gray-50 shadow-md"},R={class:"flex items-center space-x-10"},I={class:"hidden lg:block flex justify-between space-x-16 items-center text-sm"},T={class:"flex gap-10"},V={class:"absolute z-50 mt-2 w-48 bg-white border border-gray-200 shadow-md rounded-md"},A={key:0},B={key:1},S={class:"border-b border-gray-100 bg-white"},$={class:"items-center space-y-1 pb-3 pt-2"},G={__name:"GuestLayout",setup(N){h(!1);const b=m(),i=x(()=>{var t,e;return((e=(t=b.props.value)==null?void 0:t.route)==null?void 0:e.name)||""}),c=m().props.auth.user!==null,v=h(!1),f=h(!1);function y(){f.value=!f.value}return(t,e)=>(g(),p("div",M,[r("header",L,[r("button",{class:"lg:hidden focus:outline-none",onClick:y,"aria-label":"Toggle Menu"},e[2]||(e[2]=[r("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6 text-red-700",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[r("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16m-7 6h7"})],-1)])),o(a(l),{href:t.route("home")},{default:s(()=>e[3]||(e[3]=[r("img",{src:"/images/logo_1.png",alt:"DCVend Logo",class:"h-12 md:h-20"},null,-1)])),_:1},8,["href"]),r("div",R,[r("nav",I,[r("div",T,[o(a(l),{href:t.route("home"),class:d(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",i.value=="home"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[4]||(e[4]=[n(" Home ")])),_:1},8,["href","class"]),o(a(l),{href:t.route("about"),class:d(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",i.value=="about"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[5]||(e[5]=[n(" About Us ")])),_:1},8,["href","class"]),r("div",{class:"relative",onMouseenter:e[0]||(e[0]=w=>v.value=!0),onMouseleave:e[1]||(e[1]=w=>v.value=!1)},[e[8]||(e[8]=r("div",null,[r("button",{class:"text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2 focus:outline-none"}," Contact Us ")],-1)),o(U,{name:"fade"},{default:s(()=>[k(r("div",V,[o(a(l),{href:t.route("contact-us"),class:d(["block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100",{"font-semibold text-red-600":i.value==="contact-us"}])},{default:s(()=>e[6]||(e[6]=[n(" Reach Us ")])),_:1},8,["href","class"]),o(a(l),{href:t.route("refund"),class:d(["block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100",{"font-semibold text-red-600":i.value==="refund"}])},{default:s(()=>e[7]||(e[7]=[n(" Refund ")])),_:1},8,["href","class"])],512),[[C,v.value]])]),_:1})],32),o(a(l),{href:t.route("join-licensee"),class:d(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",i.value=="join-licensee"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[9]||(e[9]=[n(" Join Us as Licensee ")])),_:1},8,["href","class"]),o(a(l),{href:t.route("register",{refID:"web"}),class:d(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",i.value=="register"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[10]||(e[10]=[n(" Sign Up ")])),_:1},8,["href","class"]),o(a(l),{href:t.route("forget"),class:d(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",i.value=="forget"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[11]||(e[11]=[n(" Reset Password ")])),_:1},8,["href","class"])])]),c?(g(),p("div",B,[o(a(l),{href:t.route("dashboard")},{default:s(()=>e[13]||(e[13]=[r("img",{src:"/images/components/hi_member_button_1.png",class:"h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg",alt:""},null,-1)])),_:1},8,["href"])])):(g(),p("div",A,[o(a(l),{href:t.route("login")},{default:s(()=>e[12]||(e[12]=[r("img",{src:"/images/components/login_button_1.png",class:"h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg",alt:""},null,-1)])),_:1},8,["href"])]))])]),r("nav",S,[r("div",{class:d([{block:f.value,hidden:!f.value},"sm:hidden"])},[r("div",$,[o(u,{href:t.route("home"),active:t.route().current("home")},{default:s(()=>e[14]||(e[14]=[n(" Home ")])),_:1},8,["href","active"]),o(u,{href:t.route("about"),active:t.route().current("about")},{default:s(()=>e[15]||(e[15]=[n(" About Us ")])),_:1},8,["href","active"]),o(u,{href:t.route("contact-us"),active:t.route().current("contact-us")},{default:s(()=>e[16]||(e[16]=[n(" Contact Us ")])),_:1},8,["href","active"]),o(u,{href:t.route("refund"),active:t.route().current("refund")},{default:s(()=>e[17]||(e[17]=[n(" Refund ")])),_:1},8,["href","active"]),o(u,{href:t.route("join-licensee"),active:t.route().current("join-licensee")},{default:s(()=>e[18]||(e[18]=[n(" Join Us as Licensee ")])),_:1},8,["href","active"]),o(u,{href:t.route("register",{refID:"web"}),active:t.route().current("register")},{default:s(()=>e[19]||(e[19]=[n(" Sign Up ")])),_:1},8,["href","active"]),o(u,{href:t.route("forget"),active:t.route().current("forget")},{default:s(()=>e[20]||(e[20]=[n(" Reset Password ")])),_:1},8,["href","active"])])],2)]),r("main",null,[j(t.$slots,"default",{},void 0,!0)]),e[21]||(e[21]=r("footer",{class:"text-center pt-5 pb-10 bg-gray-50"},[r("p",{class:"text-sm text-gray-500"}," © 2024 DCVIC PTE. LTD. All rights reserved. ")],-1))]))}},H=D(G,[["__scopeId","data-v-f31ea648"]]);export{H as G};
