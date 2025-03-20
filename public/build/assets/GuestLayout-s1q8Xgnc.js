import{r as g,X as c,l as y,o as h,h as v,b as t,a as o,w as s,u as a,i as l,d as n,n as i,C as w}from"./app-BoiT7jCU.js";import{_ as u}from"./ResponsiveNavLink-CNt3-0Or.js";import{_ as x}from"./_plugin-vue_export-helper-DlAUqK2U.js";const k={class:"min-h-screen flex flex-col bg-gray-100"},C={class:"flex justify-between items-center px-4 py-4 bg-gray-50 shadow-md"},U={class:"flex items-center space-x-10"},j={class:"hidden lg:block flex justify-between space-x-16 items-center text-sm"},L={class:"flex gap-10"},D={key:0},M={key:1},V={class:"border-b border-gray-100 bg-white"},A={class:"items-center space-y-1 pb-3 pt-2"},B={__name:"GuestLayout",setup(I){g(!1);const p=c(),d=y(()=>{var r,e;return((e=(r=p.props.value)==null?void 0:r.route)==null?void 0:e.name)||""}),m=c().props.auth.user!==null,f=g(!1);function b(){f.value=!f.value}return(r,e)=>(h(),v("div",k,[t("header",C,[t("button",{class:"lg:hidden focus:outline-none",onClick:b,"aria-label":"Toggle Menu"},e[0]||(e[0]=[t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6 text-red-700",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16m-7 6h7"})],-1)])),o(a(l),{href:r.route("home")},{default:s(()=>e[1]||(e[1]=[t("img",{src:"/images/logo_1.png",alt:"DCVend Logo",class:"h-12 md:h-20"},null,-1)])),_:1},8,["href"]),t("div",U,[t("nav",j,[t("div",L,[o(a(l),{href:r.route("home"),class:i(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",d.value=="home"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[2]||(e[2]=[n(" Home ")])),_:1},8,["href","class"]),o(a(l),{href:r.route("about"),class:i(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",d.value=="about"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[3]||(e[3]=[n(" About Us ")])),_:1},8,["href","class"]),o(a(l),{href:r.route("contact-us"),class:i(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",d.value=="contact-us"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[4]||(e[4]=[n(" Contact Us ")])),_:1},8,["href","class"]),o(a(l),{href:r.route("join-licensee"),class:i(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",d.value=="join-licensee"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[5]||(e[5]=[n(" Join Us as Licensee ")])),_:1},8,["href","class"]),o(a(l),{href:r.route("register",{refID:"web"}),class:i(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",d.value=="register"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[6]||(e[6]=[n(" Sign Up ")])),_:1},8,["href","class"]),o(a(l),{href:r.route("forget"),class:i(["text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2",d.value=="forget"?"underline decoration-red-600 decoration-2":""])},{default:s(()=>e[7]||(e[7]=[n(" Reset Password ")])),_:1},8,["href","class"])])]),m?(h(),v("div",M,[o(a(l),{href:r.route("dashboard")},{default:s(()=>e[9]||(e[9]=[t("img",{src:"/images/components/hi_member_button_1.png",class:"h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg",alt:""},null,-1)])),_:1},8,["href"])])):(h(),v("div",D,[o(a(l),{href:r.route("login")},{default:s(()=>e[8]||(e[8]=[t("img",{src:"/images/components/login_button_1.png",class:"h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg",alt:""},null,-1)])),_:1},8,["href"])]))])]),t("nav",V,[t("div",{class:i([{block:f.value,hidden:!f.value},"sm:hidden"])},[t("div",A,[o(u,{href:r.route("home"),active:r.route().current("home")},{default:s(()=>e[10]||(e[10]=[n(" Home ")])),_:1},8,["href","active"]),o(u,{href:r.route("about"),active:r.route().current("about")},{default:s(()=>e[11]||(e[11]=[n(" About Us ")])),_:1},8,["href","active"]),o(u,{href:r.route("contact-us"),active:r.route().current("contact-us")},{default:s(()=>e[12]||(e[12]=[n(" Contact Us ")])),_:1},8,["href","active"]),o(u,{href:r.route("join-licensee"),active:r.route().current("join-licensee")},{default:s(()=>e[13]||(e[13]=[n(" Join Us as Licensee ")])),_:1},8,["href","active"]),o(u,{href:r.route("register",{refID:"web"}),active:r.route().current("register")},{default:s(()=>e[14]||(e[14]=[n(" Sign Up ")])),_:1},8,["href","active"]),o(u,{href:r.route("forget"),active:r.route().current("forget")},{default:s(()=>e[15]||(e[15]=[n(" Reset Password ")])),_:1},8,["href","active"])])],2)]),t("main",null,[w(r.$slots,"default",{},void 0,!0)]),e[16]||(e[16]=t("footer",{class:"text-center pt-5 pb-10 bg-gray-50"},[t("p",{class:"text-sm text-gray-500"}," © 2024 DCVIC PTE. LTD. All rights reserved. ")],-1))]))}},P=x(B,[["__scopeId","data-v-355479e2"]]);export{P as G};
