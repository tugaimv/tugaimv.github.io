(this["webpackJsonpreact-stopwatch-nimble"]=this["webpackJsonpreact-stopwatch-nimble"]||[]).push([[0],{18:function(e,t,n){},19:function(e,t,n){},27:function(e,t,n){"use strict";n.r(t);var r,i=n(0),s=n.n(i),c=n(7),a=n.n(c),o=(n(18),n(19),n(12)),d=n(3),u=n(6),l=n(13),m=n(4),f=Object(m.b)("timers/timerStarted",(function(e,t){return{intervalId:setInterval((function(){return t.dispatch(O(e))}),1e3),timerId:e}})),p=Object(m.b)("timers/timersStartedAfterLoad",(function(e,t){return t.getState().timers.map((function(e){var n;return e.stop||(n=setInterval((function(){return t.dispatch(O(e.id))}),1e3)),{timerId:e.id,intervalId:n}}))})),j=Object(m.c)({name:"timers",initialState:[],reducers:{timerAdded:function(e,t){e.unshift(t.payload)},timersAddedFromStorage:function(e,t){e.unshift.apply(e,Object(l.a)(t.payload))},timerRemoved:function(e,t){var n=e.findIndex((function(e){return e.id===t.payload}));e.splice(n,1)},timerStopped:function(e,t){var n=e.find((function(e){return e.id===t.payload}));n.stop=!n.stop,n.intervalId=null},timerTick:function(e,t){var n=e.find((function(e){return e.id===t.payload}));n.seconds=++n.seconds,n.seconds<10&&(n.seconds="0"+n.seconds),n.seconds>59&&(n.seconds="00",n.minutes=++n.minutes,n.minutes<10&&(n.minutes="0"+n.minutes),n.minutes>59&&(n.minutes="00",n.hours=++n.hours,n.hours<10&&(n.hours="0"+n.hours)))}},extraReducers:(r={},Object(u.a)(r,f.fulfilled,(function(e,t){var n=t.payload,r=n.intervalId,i=n.timerId,s=e.find((function(e){return e.id===i}));s.stop=!s.stop,s.intervalId=r})),Object(u.a)(r,p.fulfilled,(function(e,t){t.payload.forEach((function(t){var n=t.timerId,r=t.intervalId;e.find((function(e){return e.id===n})).intervalId=r}))})),r)}),b=j.actions,v=b.timerAdded,h=b.timerStopped,O=b.timerTick,x=b.timerRemoved,I=b.timersAddedFromStorage,_=j.reducer,N=n(1),w=function(){var e=Object(i.useState)(""),t=Object(o.a)(e,2),n=t[0],r=t[1],s=Object(d.b)();return Object(N.jsx)("form",{onSubmit:function(e){e.preventDefault();var t={id:Math.random(),stop:!0,hours:"00",minutes:"00",seconds:"00"};if(n)t.timerName=n;else{var i=6e4*(new Date).getTimezoneOffset(),c=new Date(Date.now()-i).toISOString().split("T");t.timerName="".concat(c[0]," ").concat(c[1].slice(0,-5))}s(v(t)),s(f(t.id)),r("")},className:"tracker-form",children:Object(N.jsxs)("div",{className:"input__wrapper",children:[Object(N.jsx)("input",{type:"text",className:"tracker-form__input",placeholder:"Enter tracker name",value:n,onChange:function(e){return r(e.target.value.trim())}}),Object(N.jsx)("button",{type:"submit",className:"tracker-form__submit",children:Object(N.jsx)("span",{className:"material-icons",children:"play_arrow"})})]})})},S=n(2),g=function(){var e=Object(d.c)((function(e){return e.timers})),t=Object(d.b)();Object(i.useEffect)((function(){var t=function(){e.forEach((function(e){var t,n,r,i=Object(S.a)(Object(S.a)({},e),{},{timestampAdded:Date.now()});i.miliseconds=(t=e.hours,n=e.minutes,r=e.seconds,1e3*(60*parseInt(t,10)*60+60*parseInt(n,10)+parseInt(r,10))),localStorage.setItem(e.id,JSON.stringify(i))}))};return window.addEventListener("beforeunload",t),function(){return window.removeEventListener("beforeunload",t)}}),[e]),Object(i.useEffect)((function(){var e=function(){var e=Object.keys(localStorage).map((function(e){var t=JSON.parse(localStorage.getItem(e)),n=Date.now()-t.timestampAdded,r=function(e){var t=Math.floor(e/1e3%60),n=Math.floor(e/6e4%60),r=Math.floor(e/36e5);return{hours:r=r<10?"0"+r:r,minutes:n=n<10?"0"+n:n,seconds:t=t<10?"0"+t:t}}(t.miliseconds+n);return delete t.timestampAdded,delete t.miliseconds,t=Object(S.a)(Object(S.a)({},t),{},{hours:t.stop?t.hours:r.hours,minutes:t.stop?t.minutes:r.minutes,seconds:t.stop?t.seconds:r.seconds})}));t(I(e)),t(p()),localStorage.clear()};return window.addEventListener("load",e),function(){return window.removeEventListener("load",e)}}),[t]);return Object(N.jsx)("section",{className:"timers-list",children:Object(N.jsx)("ul",{children:e.map((function(n){var r=n.id,i=n.timerName,s=n.hours,c=n.minutes,a=n.seconds,o=n.stop;return Object(N.jsxs)("li",{className:"timers-list__item ".concat(o?"":"active"),children:[Object(N.jsx)("span",{className:"timers-list__item-name",children:i}),Object(N.jsxs)("div",{className:"timers_list__btn-block",children:[Object(N.jsx)("span",{className:"timers-list__item-value",children:"".concat(s,":").concat(c,":").concat(a)}),Object(N.jsx)("button",{className:"btn-round",onClick:function(){return function(n){var r=e.find((function(e){return e.id===n}));if(r.stop)t(f(n));else{var i=r.intervalId;clearInterval(i),t(h(n))}}(r)},children:Object(N.jsx)("span",{className:"material-icons",children:o?"play_circle_outline":"pause_circle_outline"})}),Object(N.jsx)("button",{className:"btn-round btn-round_remove",onClick:function(){return function(n){var r=e.find((function(e){return e.id===n})).intervalId;clearInterval(r),t(x(n))}(r)},children:Object(N.jsx)("span",{className:"material-icons",children:"remove_circle_outline"})})]})]},r)}))})})},y=function(){return Object(N.jsxs)("div",{className:"center",children:[Object(N.jsx)("h1",{className:"mg-0 app-name",children:"tracker"}),Object(N.jsx)(w,{}),Object(N.jsx)(g,{})]})},k=Object(m.a)({reducer:{timers:_}});a.a.render(Object(N.jsx)(s.a.StrictMode,{children:Object(N.jsx)(d.a,{store:k,children:Object(N.jsx)(y,{})})}),document.getElementById("root"))}},[[27,1,2]]]);
//# sourceMappingURL=main.cff9d220.chunk.js.map