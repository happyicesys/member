import{A as S}from"./ApplicationLogo-CG4_UCas.js";import{j as D,z as B,h as m,r as L,o as d,f as h,b as e,C as c,i as k,Q as $,a,w as r,n as u,I as M,c as _,u as v,m as b,d as l,t as y,g as N}from"./app-D-x25jTd.js";const E={class:"relative"},j={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:String,default:"py-1 bg-white"}},setup(n){const o=n,s=g=>{i.value&&g.key==="Escape"&&(i.value=!1)};D(()=>document.addEventListener("keydown",s)),B(()=>document.removeEventListener("keydown",s));const t=m(()=>({48:"w-48"})[o.width.toString()]),p=m(()=>o.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":o.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top"),i=L(!1);return(g,f)=>(d(),h("div",E,[e("div",{onClick:f[0]||(f[0]=w=>i.value=!i.value)},[c(g.$slots,"trigger")]),k(e("div",{class:"fixed inset-0 z-40",onClick:f[1]||(f[1]=w=>i.value=!1)},null,512),[[$,i.value]]),a(M,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"opacity-0 scale-95","enter-to-class":"opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"opacity-100 scale-100","leave-to-class":"opacity-0 scale-95"},{default:r(()=>[k(e("div",{class:u(["absolute z-50 mt-2 rounded-md shadow-lg",[t.value,p.value]]),style:{display:"none"},onClick:f[2]||(f[2]=w=>i.value=!1)},[e("div",{class:u(["rounded-md ring-1 ring-black ring-opacity-5",n.contentClasses])},[c(g.$slots,"content")],2)],2),[[$,i.value]])]),_:3})]))}},C={__name:"DropdownLink",props:{href:{type:String,required:!0}},setup(n){return(o,s)=>(d(),_(v(b),{href:n.href,class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"},{default:r(()=>[c(o.$slots,"default")]),_:3},8,["href"]))}},z={__name:"NavLink",props:{href:{type:String,required:!0},active:{type:Boolean}},setup(n){const o=n,s=m(()=>o.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(t,p)=>(d(),_(v(b),{href:n.href,class:u(s.value)},{default:r(()=>[c(t.$slots,"default")]),_:3},8,["href","class"]))}},x={__name:"ResponsiveNavLink",props:{href:{type:String,required:!0},active:{type:Boolean}},setup(n){const o=n,s=m(()=>o.active?"block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(t,p)=>(d(),_(v(b),{href:n.href,class:u(s.value)},{default:r(()=>[c(t.$slots,"default")]),_:3},8,["href","class"]))}},V={class:"min-h-screen bg-gray-100"},A={class:"border-b border-gray-100 bg-white"},T={class:"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"},q={class:"flex h-16 justify-between"},O={class:"flex"},P={class:"flex shrink-0 items-center"},I={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},Q={class:"hidden sm:ms-6 sm:flex sm:items-center"},R={class:"relative ms-3"},U={class:"inline-flex rounded-md"},F={type:"button",class:"inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"},G={class:"-me-2 flex items-center sm:hidden"},H={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},J={class:"space-y-1 pb-3 pt-2"},K={class:"border-t border-gray-200 pb-1 pt-4"},W={class:"px-4"},X={class:"text-base font-medium text-gray-800"},Y={class:"text-sm font-medium text-gray-500"},Z={class:"mt-3 space-y-1"},ee={key:0,class:"bg-white shadow"},te={class:"mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"},re={__name:"AuthenticatedLayout",setup(n){const o=L(!1);return(s,t)=>(d(),h("div",null,[e("div",V,[e("nav",A,[e("div",T,[e("div",q,[e("div",O,[e("div",P,[a(v(b),{href:s.route("dashboard")},{default:r(()=>[a(S,{class:"max-w-16 max-h-10"})]),_:1},8,["href"])]),e("div",I,[a(z,{href:s.route("dashboard"),active:s.route().current("dashboard")},{default:r(()=>t[1]||(t[1]=[l(" Dashboard ")])),_:1},8,["href","active"])])]),e("div",Q,[e("div",R,[a(j,{align:"right",width:"48"},{trigger:r(()=>[e("span",U,[e("button",F,[l(y(s.$page.props.auth.user.name)+" ",1),t[2]||(t[2]=e("svg",{class:"-me-0.5 ms-2 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"},[e("path",{"fill-rule":"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1))])])]),content:r(()=>[a(C,{href:s.route("profile.edit")},{default:r(()=>t[3]||(t[3]=[l(" Profile ")])),_:1},8,["href"]),a(C,{href:s.route("logout"),method:"post",as:"button"},{default:r(()=>t[4]||(t[4]=[l(" Log Out ")])),_:1},8,["href"])]),_:1})])]),e("div",G,[e("button",{onClick:t[0]||(t[0]=p=>o.value=!o.value),class:"inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"},[(d(),h("svg",H,[e("path",{class:u({hidden:o.value,"inline-flex":!o.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:u({hidden:!o.value,"inline-flex":o.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:u([{block:o.value,hidden:!o.value},"sm:hidden"])},[e("div",J,[a(x,{href:s.route("dashboard"),active:s.route().current("dashboard")},{default:r(()=>t[5]||(t[5]=[l(" Dashboard ")])),_:1},8,["href","active"])]),e("div",K,[e("div",W,[e("div",X,y(s.$page.props.auth.user.name),1),e("div",Y,y(s.$page.props.auth.user.email),1)]),e("div",Z,[a(x,{href:s.route("profile.edit")},{default:r(()=>t[6]||(t[6]=[l(" Profile ")])),_:1},8,["href"]),a(x,{href:s.route("logout"),method:"post",as:"button"},{default:r(()=>t[7]||(t[7]=[l(" Log Out ")])),_:1},8,["href"])])])],2)]),s.$slots.header?(d(),h("header",ee,[e("div",te,[c(s.$slots,"header")])])):N("",!0),e("main",null,[c(s.$slots,"default"),t[8]||(t[8]=e("div",{class:"text-center pt-14 pb-4"},[e("p",{class:"text-sm text-gray-500"},"© 2024 DCVIC PTE. LTD. All rights reserved.")],-1))])])]))}};export{re as _};
