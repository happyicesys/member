import{l as P,g as N,m as B,o as n,h as m,T as O,r as g,p as S,f as U,c as v,w as y,a as r,u as o,Z as $,b as s,t as b,k as h,v as j,j as L,F,d as _,i as k,e as I}from"./app-8oeNZdWn.js";import{G as M}from"./GuestLayout-fOi53CcN.js";import{_ as V,b as w,a as C}from"./TextInput-DaxeAeeg.js";import"./ResponsiveNavLink-2x6Sq5tF.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const q=["value"],D={__name:"Checkbox",props:{checked:{type:[Array,Boolean],required:!0},value:{default:null}},emits:["update:checked"],setup(a,{emit:f}){const t=f,d=a,c=P({get(){return d.checked},set(i){t("update:checked",i)}});return(i,p)=>N((n(),m("input",{type:"checkbox",value:a.value,"onUpdate:modelValue":p[0]||(p[0]=x=>c.value=x),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"},null,8,q)),[[B,c.value]])}},G={key:0,class:"mb-2 text-sm font-medium text-green-600"},R={class:"flex space-x-1 items-center"},E={for:"password",class:"flex items-center space-x-2"},T=["value"],A={class:"flex space-x-1 items-center"},Z={for:"password",class:"flex items-center space-x-2"},z={class:"mt-4"},H={class:"relative"},J={key:0},K={key:1},Q={class:"block mt-4"},W={class:"flex items-center"},X={class:"mt-4 flex items-center justify-between"},le={__name:"Login",props:{countryOptions:Object,canResetPassword:{type:Boolean},status:{type:String}},setup(a){const f=a,t=O({country_id:"",phone_number:"",password:"",remember:!1}),d=g(!1),c=()=>{t.post(route("login"),{onFinish:()=>t.reset("password")})},i=g([]),p=g(!1);S(()=>t.password,u=>{p.value=/^[0-9]{6}$/.test(u)},{immediate:!0}),U(()=>{i.value=f.countryOptions.data,t.country_id=i.value.filter(u=>u.is_default)[0].id});function x(){d.value=!d.value}return(u,e)=>(n(),v(M,null,{default:y(()=>[r(o($),{title:"Log in"}),e[14]||(e[14]=s("section",{class:"text-white rounded my-2 md:w-4/6 mx-auto py-5"},[s("img",{src:"/images/icon.png",alt:"Vion Icon",class:"w-1/3 lg:w-1/6 rounded mx-auto"})],-1)),a.status?(n(),m("div",G,b(a.status),1)):h("",!0),s("form",{onSubmit:I(c,["prevent"]),class:"space-y-4 lg:w-3/12 mx-auto mb-10 px-2"},[s("div",null,[s("div",R,[s("label",E,[r(V,{for:"country_id",value:"Country Code"})]),e[4]||(e[4]=s("span",{class:"text-red-600"},"*",-1))]),N(s("select",{id:"country_id",class:"mt-1 block w-full select2 rounded text-gray-600","onUpdate:modelValue":e[0]||(e[0]=l=>o(t).country_id=l),required:""},[e[5]||(e[5]=s("option",{value:"",disabled:""},"Select Country",-1)),(n(!0),m(F,null,L(i.value,l=>(n(),m("option",{key:l.id,value:l.id},b(l.phone_code)+" ("+b(l.name)+") ",9,T))),128))],512),[[j,o(t).country_id]]),r(w,{class:"mt-2",message:o(t).errors.country_id},null,8,["message"])]),s("div",null,[s("div",A,[s("label",Z,[r(V,{for:"phone_number",value:"Phone Number"})]),e[6]||(e[6]=s("span",{class:"text-red-600"},"*",-1))]),r(C,{id:"phone_number",type:"text",class:"mt-1 block w-full",modelValue:o(t).phone_number,"onUpdate:modelValue":e[1]||(e[1]=l=>o(t).phone_number=l),required:"",placeholder:"Enter your phone number"},null,8,["modelValue"]),r(w,{class:"mt-2",message:o(t).errors.phone_number},null,8,["message"])]),s("div",z,[e[9]||(e[9]=s("div",{class:"flex space-x-1 items-center"},[s("label",{for:"password",class:"flex items-center space-x-2"},[s("span",null,"Password"),s("span",{class:"text-yellow-700 text-sm"},"(6 digits PIN)")]),s("span",{class:"text-red-600"},"*")],-1)),s("div",H,[r(C,{id:"password",type:d.value?"text":"password",class:"mt-1 w-full pr-10",modelValue:o(t).password,"onUpdate:modelValue":e[2]||(e[2]=l=>o(t).password=l),placeholder:"Numbers Only"},null,8,["type","modelValue"]),s("button",{type:"button",class:"absolute inset-y-0 right-0 px-3 flex items-center text-gray-500",onClick:x},[d.value?(n(),m("span",J,e[7]||(e[7]=[s("img",{src:"/images/components/eye_close.png",alt:"hide password",class:"w-8 h-8"},null,-1)]))):(n(),m("span",K,e[8]||(e[8]=[s("img",{src:"/images/components/eye_open.png",alt:"show password",class:"w-8 h-8"},null,-1)])))])]),r(w,{class:"mt-2",message:o(t).errors.password},null,8,["message"])]),s("div",Q,[s("label",W,[r(D,{name:"remember",checked:o(t).remember,"onUpdate:checked":e[3]||(e[3]=l=>o(t).remember=l)},null,8,["checked"]),e[10]||(e[10]=s("span",{class:"ms-2 text-sm text-gray-600"},"Remember me",-1))])]),s("div",X,[r(o(k),{href:u.route("register",{refID:"web"}),class:"rounded-md text-lg text-red-600 underline hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"},{default:y(()=>e[11]||(e[11]=[_(" Sign Up? ")])),_:1},8,["href"]),a.canResetPassword?(n(),v(o(k),{key:0,href:u.route("forgot"),class:"rounded-md text-lg text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"},{default:y(()=>e[12]||(e[12]=[_(" Forgot your password? ")])),_:1},8,["href"])):h("",!0)]),e[13]||(e[13]=s("div",{class:"mt-2 flex items-center justify-center"},[s("div",{class:"flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-2 gap-8 md:w-2/5 text-center"},[s("button",{type:"submit",class:"bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400"}," LOGIN ")])],-1))],32)]),_:1}))}};export{le as default};
