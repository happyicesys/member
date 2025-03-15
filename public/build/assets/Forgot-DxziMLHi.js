import{T as F,r as p,f as M,c as x,w as P,o as l,a,u as s,Z as U,b as o,g as R,v as q,n as w,h as u,j as N,t as m,F as C,d as _,k as f,e as S,i as A}from"./app-6Z5aGBY8.js";/* empty css                                                                        */import{G as L}from"./GuestLayout-s_O4jbXE.js";import{_ as E,b as h,a as k}from"./TextInput-BflZ9M52.js";import{P as D}from"./PrimaryButton-DLwQCeTk.js";import"./ResponsiveNavLink-xgxqU0Kz.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const G=["disabled"],z=["value"],Y={key:0},Z={class:"mt-6"},H={for:"otpParts",class:"flex flex-col space-y-1 items-center mb-3"},J={class:"font-normal"},K={class:"font-light"},Q={key:0},W={class:"mt-2 grid grid-cols-6 gap-2"},X={class:"mt-6"},ee={class:"relative"},te={key:0},se={key:1},oe={class:"mt-6 flex items-center justify-end"},ne={key:1,class:"flex justify-end mt-2 text-sm text-blue-500"},re={class:"mt-2 flex items-center justify-center"},le={class:"flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-2 gap-8 md:w-2/5 text-center"},ae=["disabled"],ue={class:"mt-6 flex items-center justify-end"},ye={__name:"Forgot",props:{countryOptions:Object},setup(O){const B=O,e=F({country_id:"",phone_number:"",otpParts:["","","","",""],password:""}),g=p(!1),y=p(60),i=p(!1),d=p(!0),v=p(!1),b=p([]);M(()=>{b.value=B.countryOptions.data,e.country_id=b.value.filter(r=>r.is_default)[0].id});const T=()=>{e.post(route("forget.verification"),{preserveState:!0,preserveScroll:!0,replace:!0,onSuccess:()=>{g.value=!0,i.value=!0,d.value=!1,y.value=60;const r=setInterval(()=>{y.value>0?y.value--:(clearInterval(r),i.value=!1)},1e3)}})},j=r=>{if(e.otpParts[r].length===1&&r<e.otpParts.length-1){const t=document.getElementById(`otp_${r+1}`);t&&t.focus()}else if(e.otpParts[r].length===0&&r>0){const t=document.getElementById(`otp_${r-1}`);t&&t.focus()}},I=()=>{e.post(route("pin.reset"),{onFinish:()=>e.reset("otpParts","password")})};function $(){v.value=!v.value}return(r,t)=>(l(),x(L,null,{default:P(()=>[a(s(U),{title:"Reset PIN"}),t[12]||(t[12]=o("section",{class:"text-white rounded my-2 md:w-4/6 mx-auto py-5"},[o("img",{src:"/images/icon.png",alt:"Vion Icon",class:"w-1/3 lg:w-1/6 rounded mx-auto"})],-1)),t[13]||(t[13]=o("div",{class:"text-center mb-8"},[o("h1",{class:"text-3xl font-bold text-gray-800"},"Reset Your PIN"),o("p",{class:"mt-2 text-gray-600"},"Enter your phone number to receive a one-time password (OTP) to reset your PIN.")],-1)),o("form",{onSubmit:S(I,["prevent"]),class:"space-y-4 lg:w-3/12 mx-auto mb-10 px-2"},[o("div",null,[a(E,{for:"country_id",value:"Country Code"}),R(o("select",{id:"country_id",class:w(["mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500",{"bg-gray-100":!d.value,"cursor-not-allowed":!d.value}]),disabled:!d.value,"onUpdate:modelValue":t[0]||(t[0]=n=>s(e).country_id=n),required:""},[t[4]||(t[4]=o("option",{value:"",disabled:""},"Select Country",-1)),(l(!0),u(C,null,N(b.value,n=>(l(),u("option",{key:n.id,value:n.id},m(n.phone_code)+" ("+m(n.name)+") ",9,z))),128))],10,G),[[q,s(e).country_id]]),a(h,{class:"mt-2",message:s(e).errors.country_id},null,8,["message"])]),o("div",null,[a(E,{for:"phone_number",value:"Phone Number"}),a(k,{id:"phone_number",type:"text",class:w(["mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500",{"bg-gray-100":!d.value,"cursor-not-allowed":!d.value}]),modelValue:s(e).phone_number,"onUpdate:modelValue":t[1]||(t[1]=n=>s(e).phone_number=n),disabled:!d.value,required:"",placeholder:"Enter your phone number"},null,8,["class","modelValue","disabled"]),a(h,{class:"mt-2",message:s(e).errors.phone_number},null,8,["message"])]),g.value?(l(),u("div",Y,[t[9]||(t[9]=o("hr",{class:"mt-6"},null,-1)),o("div",Z,[o("label",H,[o("span",J," Enter 5-digits OTP sent to "+m(b.value.find(n=>n.id==s(e).country_id).phone_code)+m(s(e).phone_number),1),o("span",K,[t[5]||(t[5]=_(" (Expiring in 2 minutes")),r.nowAddTwoMinutes?(l(),u("span",Q,", ")):f("",!0),_(m(r.nowAddTwoMinutes)+") ",1)])]),o("div",W,[(l(!0),u(C,null,N(s(e).otpParts,(n,c)=>(l(),x(k,{key:c,id:"otp_"+c,class:"block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50",maxlength:"1",modelValue:s(e).otpParts[c],"onUpdate:modelValue":V=>s(e).otpParts[c]=V,onInput:V=>j(c),inputmode:"numeric",type:"text",pattern:"[0-9]*",required:"",ref_for:!0,ref:"otpInputs"},null,8,["id","modelValue","onUpdate:modelValue","onInput"]))),128))]),a(h,{class:"mt-2",message:s(e).errors.passwordParts},null,8,["message"])]),o("div",X,[t[8]||(t[8]=o("label",{for:"password",class:"flex items-center space-x-2"},[o("span",null,"Password"),o("span",{class:"text-yellow-700 text-sm"},"(Choose your 6 digits PIN)")],-1)),o("div",ee,[a(k,{id:"password",type:v.value?"text":"password",class:"mt-1 w-full pr-10",modelValue:s(e).password,"onUpdate:modelValue":t[2]||(t[2]=n=>s(e).password=n),onInput:t[3]||(t[3]=n=>r.onInputUpdate()),placeholder:"Numbers Only"},null,8,["type","modelValue"]),o("button",{type:"button",class:"absolute inset-y-0 right-0 px-3 flex items-center text-gray-500",onClick:$},[v.value?(l(),u("span",te,t[6]||(t[6]=[o("img",{src:"/images/components/eye_close.png",alt:"hide password",class:"w-8 h-8"},null,-1)]))):(l(),u("span",se,t[7]||(t[7]=[o("img",{src:"/images/components/eye_open.png",alt:"show password",class:"w-8 h-8"},null,-1)])))])]),a(h,{class:"mt-2",message:s(e).errors.password},null,8,["message"])])])):f("",!0),o("div",oe,[g.value?f("",!0):(l(),x(D,{key:0,onClick:S(T,["prevent"]),class:w(["ms-2",{"opacity-25":!s(e).country_id||!s(e).phone_number||i.value,"cursor-not-allowed":!s(e).country_id||!s(e).phone_number||i.value}]),disabled:!s(e).country_id||!s(e).phone_number||i.value},{default:P(()=>t[10]||(t[10]=[_(" Send OTP ")])),_:1},8,["class","disabled"]))]),i.value?(l(),u("div",ne," Resend SMS in "+m(y.value)+" seconds... ",1)):f("",!0),o("div",re,[o("div",le,[g.value?(l(),u("button",{key:0,onClick:I,type:"submit",class:w(["bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400",{"opacity-25":!s(e).password||s(e).otpParts.some(n=>n===""),"cursor-not-allowed":!s(e).password||s(e).otpParts.some(n=>n==="")}]),disabled:!s(e).password||s(e).otpParts.some(n=>n==="")}," RESET PIN ",10,ae)):f("",!0)])]),o("div",ue,[a(s(A),{href:r.route("login"),class:"rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"},{default:P(()=>t[11]||(t[11]=[_(" Back to Login ")])),_:1},8,["href"])])],32)]),_:1}))}};export{ye as default};
