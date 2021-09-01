/*
 * jLinq 2.2.1 (Packed) : 9-12-2009
 * ---------------------------------
 * Hugo Bonacci (webdev_hb@yahoo.com)
 * www.hugoware.net
 * License: Attribution-Share Alike
 * http://creativecommons.org/licenses/by-sa/3.0/us/
 */

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('h 1v;(f(){h 35=f(1D){h 27=3D;h B={};B.1D=1D;27.38=f(2t){27.38=C;B.48=E;B.2t=2t};B.1w={2S:f(2r,2q){d 2r.1H().2H(/%[0-9]+%/3C,f(H){h 1U=3B(H.2H(/%/3C,""));d 2q[1U]})},3Q:f(2a){h 33=[];F(h i=0;i<2a.q;i++){m(2a[i]==C){d 33}33.I(2a[i])}d 33},2v:f(x){m(x==C){d""}d x.1H().2H(/^\\s+|\\s+$/,"")},25:f(2a){F(h i=0;i<2a.q;i++){m(2a[i]){d K}}d E},n:f(x){m(x==C){d"C"}m(x==30){d"C"}F(h J 1I B.29){2k{m(B.29[J](x)){d J}}2n(e){}}d(2P(x)).1H().3A()},V:f(x,1L){h n=B.1w.n(x);m(!1L[n]){m(1L.25&&(x==C||x==30)){d 1L.25(x)}m(1L.1o){d 1L.1o(x)}d K}2k{d 1L[n](x)}2n(e){d K}},3z:f(x,1L){h n=B.1w.n(x);m(!1L[n]){m(1L.25&&(x==C||x==30)){d 1L.25(x)}m(1L.1o){d 1L.1o(x)}d C}2k{d 1L[n](x)}2n(e){d C}},2u:f(1p,1E){h t=[];F(h i=0;i<1p.q;i++){2k{t.I(1E(1p[i],i))}2n(e){t.I(e)}}d t},2j:f(2x){f 2y(){};2y.5f=2x;d 2R 2y()}};27.3J=f(p,1q){p=B.1w.2v(p).3A();B.29[p]=1q};27.5e=f(p){p=B.1w.2v(p).3A();B.29[p]=f(){d K}};B.29=1D.29?1D.29:{};27.1u=f(w){w.p=B.1w.2v(w.p);w.1X=B.1w.2v(w.1X);m(B.1u.3S(w)){m(B.2t){3W"2J: 5d 45 3a.";}B.1u.3w(w)}B.1u.3L(w);m(w.n.H(/1S/i)){m(w.1X&&!27[w.1X]){27[w.1X]={}}h 2d=w.1X==""?27:27[w.1X];2d[w.p]=f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){h t=w.v({u:B.1w},1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N);m(B.1w.n(t)!="1p"){3W"2J: A \'5c\' 50 4Z d 4Y 1p F a 1v c.";}d 2R B.c(t)}}};B.1u={G:[],3S:f(w){d(B.1u.3u(w)!=C)},3L:f(w){B.1u.3w(w);B.1u.G.I(w)},3w:f(w){h 1U=B.1u.3u(w);m(1U){B.1u.G.3N(1U,1)}},3u:f(w){F(h i=0;i<B.1u.G.q;i++){h v=B.1u.G[i];m(v.p==w.p&&v.1X==w.1X){d i}}d C}};27.4X=f(){d B.1w.2j(B.1u.G)};F(h J 1I 1D.1u){27.1u(1D.1u[J])}B.c=f(1t){h 2h=3D;1t=B.1w.2j(1t);h y={};y.o={4W:E,3s:C,3q:C,46:C,3H:0,2B:E,2G:K,1z:K,1t:1t,1T:K,1Q:"",2o:{3p:f(2r){},2L:f(2r,2q){y.o.2o.3p(B.1w.2S(2r,2q))}}};m(1t==C){d C}m(B.1w.n(1t)=="1p"&&1t.q>0){y.o.1T=(B.1w.n(1t[0])=="3X")}y.c={2N:[],2U:[],42:f(1E){y.c.2N.I(1E);h 1z=y.o.1z?"!":"";m(y.c.2N.q==0){y.o.1Q=""}y.o.2G=K;y.o.1z=K;y.c.2U.I([y.o.1Q,"(",1z,"(y.c.2N[",(y.c.2N.q-1),"](1M)))"].2D(""));y.o.1Q="&&"},1s:f(){m(y.c.2U.q==0){d{1x:y.o.1t,1B:[]}}h c;3o(["c = f(1M) {"+" d (",y.c.2U.2D(""),"); };"].2D(""));h 1x=[];h 1B=[];F(h i=0;i<y.o.1t.q;i++){h J=y.o.1t[i];2k{m(c(J)){1x.I(J)}28{1B.I(J)}}2n(e){y.o.2o.2L("2J V 4V 4U c F z: %0%. c: %1%",[e,c]);1B.I(J)}}d{1x:1x,1B:1B}},3T:f(w,2q){y.o.3s=w.3b;y.o.3H=w.1n;y.o.46=w.p;h 2A=[];h 3k=K;F(h i=2q.q;i-->0;){m(!2q[i]&&!3k){4T}3k=E;2A.I(2q[i])}2A.2E();m(y.o.1T&&2A.q==w.1n+1){y.o.3q=2A.4S()}d{1r:2A,1l:y.o.3q}},47:f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){m(y.u.25([1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N])){d}y.o.3s(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)},3i:f(1y,1l,2b){1y.2w(f(a,b){a=a[1l];b=b[1l];d(a<b)?-1:(a>b)?1:0});m(2b){1y.2E()}}};y.u={3P:f(x){m(x==C){d""}d x.1H().2H(/\\*|\\(|\\)|\\\\|\\/|\\?|\\.|\\*|\\+|\\<|\\>|\\[|\\]|\\=|\\&|\\$|\\^/3C,f(H){d("\\\\"+H)})},3h:f(2x){m(2x.q){d 2x.q}d 2x},2v:B.1w.2v,H:f(x,2m){m(!(x&&2m)){d K}m(y.u.n(2m)=="3g"){2m=2m.1S}2m=2R 4R(2m,"g"+(y.o.2B?"i":""));d(x.H(2m))},37:f(1m,1A){m(1m==C&&1A==C){d E}m(1m==C||1A==C){d K}F(h p 1I 1m){m(1A[p]==30){d K}m(!y.u.1Y(1m[p],1A[p])){d K}}d E},1Y:f(1m,1A){2k{m(1m==C&&1A==C){d E}m((1m==C&&1A)||(1m&&1A==C)){d K}h 2l=y.u.n(1m);h 2Y=y.u.n(1A);m(2l!=2Y){d K}m(2l=="1W"&&2Y=="1W"){d y.u.H(1m,"^"+1A+"$")}m(2l=="1W"&&2Y=="3g"){d y.u.H(1m,1A)}m(2l=="1V"||2l=="31"){d(1m==1A)}28 m(2l=="1p"||2l=="3X"){m(1m.q!=1A.q){d K}F(h i=0;i<1m.q;i++){m(!y.u.1Y(1m[i],1A[i])){d K}}d E}28{d(1m==1A)}}2n(e){d K}},4O:f(1m,1A){m(B.u.n(1m)!="1p"){1m=[1m]}F(h J 1I 1m){m(!B.u.1Y(1m[J],1A)){d K}}d E},4N:f(1m,1A){m(B.u.n(1m)!="1p"){1m=[1m]}F(h J 1I 1m){m(!B.u.1Y(1m[J],1A)){d E}}d K},2w:f(1y,2p,2b){m(2p==C){1y.2w();m(2b){c.o.1t.2E()}d 1y}h 1U=0;h 3f=f(1y){1y=B.1w.2j(1y);h 1l=2p[1U].1l;h 2b=2p[1U].2b;m(1U==2p.q-1){y.c.3i(1y,1l,2b);d 1y};y.c.3i(1y,1l,2b);h 26=y.u.2M(1y,1l);1U++;h t=[];F(h j=0;j<26.q;j++){h 3d=3f(26[j].3c);F(h k=0;k<3d.q;k++){t.I(3d[k])}};d t};d 3f(y.o.1t)},2M:f(1y,1l){h 26=[];F(h i=0;i<1y.q;i++){h x=1y[i];h 2C=(1l!=C)?3o(["(x.",1l,")"].2D("")):x;h 3l=K;F(h J 1I 26){m(26[J].2C===2C){3l=E;26[J].3c.I(x);4M}}m(!3l){26.I({2C:2C,3c:[x]})}}d 26},25:B.1w.25,n:B.1w.n,V:B.1w.V,2u:B.1w.2u,2S:B.1w.2S,2j:B.1w.2j,39:B.1w.3Q,3z:B.1w.3z};F(h J 1I B.1u.G){(f(w){m(!(w.n||w.p||w.v)){d}m(w.n.H(/1S/i)){d}m(w.1X&&!2h[w.1X]){2h[w.1X]={}}h 2d=w.1X?2h[w.1X]:2h;h v=(f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.o.2o.2L("4K 3b %0% \'%1%()\'.",[w.n,w.p]);h o={2Q:f(G){y.c.2U.I(G)},c:2h,o:y.o,u:y.u,2z:f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.c.47(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}};m(w.n.H(/^c$/i)){h G=y.c.3T({3b:2d[w.p],1n:w.1n,p:w.p},[1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N]);y.c.42(f(1M){2k{o.l=y.o.1T?3o("1M."+G.1l):1M}2n(e){y.o.2o.2L("2J V 44 \'%0%()\' : %1%.",[w.p,e]);o.l=C}o.1M=1M;o.n=o.u.n(o.l);o.V=f(1L){d y.u.V(o.l,1L)};d w.v(o,G.1r[0],G.1r[1],G.1r[2],G.1r[3],G.1r[4],G.1r[5],G.1r[6],G.1r[7],G.1r[8],G.1r[9],G.1r[10],G.1r[11],G.1r[12],G.1r[13],G.1r[14],G.1r[15],G.1r[16],G.1r[17],G.1r[18],G.1r[19],G.1r[20],G.1r[21],G.1r[22],G.1r[23],G.1r[24])});d 2h}28 m(w.n.H(/^1E$/i)){2k{w.v(o,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}2n(e){y.o.2o.2L("2J V 44 \'%0%()\' : %1%.",[w.p,e])}d 2h}28 m(w.n.H(/^z$/i)){o.t=w.2f?[]:y.c.1s();o.1s=y.c.1s;d w.v(o,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}d 2h});2d[w.p]=v;m(w.n.H(/^c$/i)&&(B.1D.2T==C||B.1D.2T)&&(w.2T==C||w.2T)){h 2F=w.p.3r(0,1).4z()+w.p.3r(1,w.p.q-1);2d["2G"+2F]=f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.o.1Q="||";d v(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)};2d["3Y"+2F]=f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.o.1Q="&&";d v(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)};2d["1z"+2F]=f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.o.1z=!y.o.1z;d v(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)};2d["3Z"+2F]=f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.o.1z=!y.o.1z;y.o.1Q="&&";d v(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)};2d["40"+2F]=f(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){y.o.1z=!y.o.1z;y.o.1Q="||";d v(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}}})(B.1u.G[J])}}};h 3t=f(){d{3a:E,2T:E,29:{1p:f(x){d(x.I&&x.4w&&x.2E&&x.3v&&x.3N)},"f":f(x){d((2P(x)).1H().H(/^f$/i))},1W:f(x){d((2P(x)).1H().H(/^1W$/i))},1V:f(x){d((2P(x)).1H().H(/^1V$/i))},31:f(x){d((2P(x)).1H().H(/^4v$/i))},3g:f(x){d(x.2B!=C&&x.4q!=C&&x.4p)},2e:f(x){d(x.4g&&x.4e&&x.4a&&x.5g)}},1u:[{p:"1C",n:"1S",v:f(c,1S){d c.u.V(1S,{"f":f(){d 1S()},1p:f(){d 1S},1o:f(){d[1S]}})}},{p:"2o",n:"1E",49:K,v:f(c,1O){c.o.2o.3p=1O}},{p:"2E",n:"1E",v:f(c){c.o.1t.2E()}},{p:"2B",n:"1E",v:f(c){c.o.2B=E}},{p:"4b",n:"1E",v:f(c){c.o.2B=K}},{p:"2G",n:"1E",v:f(c,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){c.o.1Q="||";c.2z(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}},{p:"1z",n:"1E",v:f(c,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){c.o.1z=!c.o.1z;c.2z(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}},{p:"3Y",n:"1E",v:f(c,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){c.o.1Q="&&";c.2z(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}},{p:"40",n:"1E",v:f(c,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){c.o.2G=E;c.o.1z=!c.o.1z;c.2z(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}},{p:"3Z",n:"1E",v:f(c,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){c.o.2G=K;c.o.1z=!c.o.1z;c.2z(1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N)}},{p:"4c",n:"1E",v:f(c,1O){c.2Q(c.o.1Q+"("+(c.o.1z?"!":""));c.o.1Q="";1O(c.c);c.2Q(")")}},{p:"4d",n:"1E",v:f(c,1O){c.o.1Q="||";c.2Q(c.o.1Q+"("+(c.o.1z?"!":""));c.o.1Q="";1O(c.c);c.2Q(")")}},{p:"2I",1n:-1,n:"c",v:f(c,1O){d 1O(c.1M,c.u)}},{p:"4f",1n:1,n:"c",v:f(c,l){h 3y=3B(l.1H(),16);h 1q=3B(c.l.1H(),16);d((1q&3y)==3y)}},{p:"1Y",1n:1,n:"c",v:f(c,l){d c.u.1Y(c.l,l)}},{p:"4h",1n:1,n:"c",v:f(c,l){m(c.u.n(l)!="1p"){l=[l]}F(h J 1I l){h H=l[J];m(c.V({1p:f(){d c.u.1Y(c.l[0],H)},1o:f(){d c.u.H(c.l.1H(),"^"+H.1H())}})){d E}}}},{p:"4i",1n:1,n:"c",v:f(c,l){m(c.u.n(l)!="1p"){l=[l]}F(h J 1I l){h H=l[J];m(c.V({1p:f(){d c.u.1Y(c.l[c.l.q-1],H)},1o:f(){d c.u.H(c.l.1H(),H.1H()+"$")}})){d E}}}},{p:"4j",1n:1,n:"c",v:f(c,l){m(l==C){d K}m(c.u.n(l)!="1p"){l=[l]}F(h J 1I l){h H=l[J];m(c.V({1p:f(){F(h i=0;i<c.l.q;i++){m(c.u.1Y(c.l[i],H)){d E}}},1o:f(){d c.u.H(c.l.1H(),"^.*"+c.u.3P(H)+".*$")}})){d E}}}},{p:"H",1n:1,n:"c",v:f(c,l){m(c.u.n(l)!="1p"){l=[l]}F(h J 1I l){h H=l[J];m(c.V({1p:f(){F(h i=0;i<c.l.q;i++){m(c.u.H(c.l[i],H)){d E}}},1o:f(){d c.u.H(c.l.1H(),H)}})){d E}}}},{p:"4k",1n:1,n:"c",v:f(c,l){l=c.u.V(l,{1V:f(){d l},2e:f(){d l},1o:f(){d l.q}});d c.V({1W:f(){d(c.l.q<l)},1p:f(){d(c.l.q<l)},1o:f(){d(c.l<l)}})}},{p:"4l",1n:1,n:"c",v:f(c,l){l=c.u.V(l,{1V:f(){d l},2e:f(){d l},1o:f(){d l.q}});d c.V({1W:f(){d(c.l.q>l)},1p:f(){d(c.l.q>l)},1o:f(){d(c.l>l)}})}},{p:"4m",1n:1,n:"c",v:f(c,l){l=c.u.V(l,{1V:f(){d l},2e:f(){d l},1o:f(){d l.q}});d c.V({1W:f(){d(c.l.q<=l)},1p:f(){d(c.l.q<=l)},1o:f(){d(c.l<=l)}})}},{p:"4n",1n:1,n:"c",v:f(c,l){l=c.u.V(l,{1V:f(){d l},2e:f(){d l},1o:f(){d l.q}});d c.V({1W:f(){d(c.l.q>=l)},1p:f(){d(c.l.q>=l)},1o:f(){d(c.l>=l)}})}},{p:"4o",1n:2,n:"c",v:f(c,1K,1J){1K=c.u.V(1K,{1V:f(){d 1K},2e:f(){d l},1o:f(){d 1K.q}});1J=c.u.V(1J,{1V:f(){d 1J},1o:f(){d 1J.q}});d c.V({1W:f(){d(c.l.q>1K&&c.l.q<1J)},1p:f(){d(c.l.q>1K&&c.l.q<1J)},1o:f(){d(c.l>1K&&c.l<1J)}})}},{p:"4r",1n:2,n:"c",v:f(c,1K,1J){1K=c.u.V(1K,{1V:f(){d 1K},2e:f(){d l},1o:f(){d 1K.q}});1J=c.u.V(1J,{1V:f(){d 1J},2e:f(){d l},1o:f(){d 1J.q}});d c.V({1W:f(){d(c.l.q>=1K&&c.l.q<=1J)},1p:f(){d(c.l.q>=1K&&c.l.q<=1J)},1o:f(){d(c.l>=1K&&c.l<=1J)}})}},{p:"25",1n:0,n:"c",v:f(c){d c.V({1p:f(){d(c.l.q==0)},1W:f(){d(c.l=="")},25:f(){d E}})}},{p:"45",1n:0,n:"c",v:f(c){d c.V({31:f(){d c.l},25:f(){d K},1o:f(){d(c.l!=C)}})}},{p:"4s",1n:0,n:"c",v:f(c){d c.V({31:f(){d!c.l},25:f(){d E},1o:f(){d(c.l==C)}})}},{p:"4t",n:"z",v:f(c){d(c.t.1x.q>0)}},{p:"39",n:"z",v:f(c){d(c.t.1x.q==c.o.1t.q)}},{p:"4u",n:"z",v:f(c){d!c.c.39()}},{p:"1n",n:"z",v:f(c,D){d D?c.t.1B.q:c.t.1x.q}},{p:"1s",n:"z",v:f(c,z,D){h 1y=[];h t=D?c.t.1B:c.t.1x;z=c.u.n(z)=="f"?z:f(r){d r};F(h i=0;i<t.q;i++){1y.I(z(t[i]))}d 1y}},{p:"4x",n:"z",2f:E,v:f(c,w,z,D){w=w?w:{};h t=c.c.1s(z,D);m(t.1n==0){d"4y t F 3D c"}h 3n=f(1R){c.u.V(1R,{2e:f(){1R=c.u.2S("%0%/%1%/%2% 3R %3%:%4% %5%",[1R.4A()+1,1R.4B(),1R.4C(),(1R.2X()>12?1R.2X()-12:1R.2X()),1R.4D(),(1R.2X()>12?"4E":"4F")])},25:f(){1R="C"},1o:f(){1R=1R.1H()}});d 1R};h 1N=["<3O 4G=\'0\' 4H=\'0\' "+(w.3j?"3j=\'"+w.3j+"\' ":"")+(w.3M?"3K=\'"+w.3M+"\' ":"")+" >"];m(c.o.1T){h 34=[];1N.I("<2Z>");F(h J 1I t[0]){34.I(J);1N.I("<3G>");1N.I(4I(J));1N.I("</3G>")}1N.I("</2Z>")}h 2O=E;F(h i=0;i<t.q;i++){2O=!2O;h 1M=t[i];1N.I("<2Z "+(2O?"3K=\'2O-4J\'":"")+">");m(c.o.1T){F(h 3E 1I 34){h J=34[3E];h x=1M[J];h 2r=3n(x);1N.I("<36>");1N.I(2r);1N.I("</36>")}}28{1N.I("<36>");1N.I(3n(1M));1N.I("</36>")}1N.I("</2Z>")}1N.I("</3O>");d 1N.2D("")}},{p:"2u",n:"z",2f:E,v:f(c,1E,z,D){h t=c.c.1s(z,D);F(h i=0;i<t.q;i++){1E(t[i],i)}d c.c}},{p:"3e",n:"z",2f:E,v:f(c,1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N){h 2i=c.u.39([1h,1g,1f,1e,1d,1b,1a,Z,L,X,W,U,T,S,R,Q,P,O,1k,1i,1j,1c,Y,M,N]);m(2i.q==0){2i=[""]}m(!c.o.1T){h 2b=(2i.q>0)?(2i[0]+"").H(/^\\-/g):K;c.o.1t=c.u.2w(c.o.1t,C,2b);d c.c}h 2p=[];F(h i=0;i<2i.q;i++){2p.I({2b:(2i[i].3r(0,1)=="-"),1l:2i[i].2H(/^\\-/g,"")})}c.o.1t=c.u.2w(c.o.1t,2p);d c.c}},{p:"2M",n:"z",v:f(c,1l,D){h 1Z=D?c.t.1B:c.t.1x;h t=c.u.2M(1Z,1l);h 26=[];F(h J 1I t){26.I(t[J].2C)}d c.u.2w(26,C,K)}},{p:"4L",n:"z",v:f(c,1l,D){h 1Z=D?c.t.1B:c.t.1x;h t=c.u.2M(1Z,1l);d 1v.1C(t)}},{p:"2D",n:"z",v:f(c,1S,2K,3F,3U){1S=c.u.2j(1S);h 2y=[];F(h i=0;i<c.o.1t.q;i++){h 1M=c.u.2j(c.o.1t[i]);h t=1v.1C(1S).1Y(3U,1M[3F]).1s();m(t.q==1){1M[2K]=t[0]}28{1M[i][2K]=t}2y.I(1M)}d 1v.1C(2y)}},{p:"4P",n:"z",v:f(c,2K,1O){F(h i=0;i<c.o.1t.q;i++){c.o.1t[i][2K]=1O(c.o.1t[i])}}},{p:"4Q",n:"z",2f:E,v:f(c,2c,1P,z,D){2c=3m.2W(c.u.n(2c)=="1V"?2c:0,0);1P=3m.2W(c.u.n(1P)=="1V"?1P:0,0);h t=c.c.1s(z,D);d t.3v(2c,(2c+1P))}},{p:"1P",n:"z",2f:E,v:f(c,1P,z,D){1P=3m.2W(c.u.n(1P)=="1V"?1P:0,0);h t=c.c.1s(z,D);d t.3v(0,1P)}},{p:"41",n:"z",2f:E,v:f(c,2g,z,D){h t=c.c.1s(z,D);d t.q>0?t[0]:2g?2g:C}},{p:"43",n:"z",2f:E,v:f(c,2g,z,D){h t=c.c.1s(z,D);d t.q>0?t[t.q-1]:2g?2g:C}},{p:"3R",n:"z",2f:E,v:f(c,1U,2g,z,D){h t=c.c.1s(z,D);d 1U<t.q||1U>=0?t[1U]:2g?2g:C}},{p:"2V",n:"z",v:f(c,1l,D){m(!c.o.1T){D=1l}h 1Z=D?c.t.1B:c.t.1x;h 1G=0;c.u.2u(1Z,f(1F){m(c.o.1T){m(1G==C){1G=1F[1l]}28{c.u.V(1F[1l],{1p:f(){1G+=1F[1l].q},1W:f(){1G+=1F[1l].q},1o:f(){1G+=1F[1l]}})}}28{c.u.V(1F,{1p:f(){1G+=1F.q},1W:f(){1G+=1F.q},1o:f(){1G+=1F}})}});d{1n:1Z.q,1G:1G,1y:1Z}}},{p:"51",n:"z",v:f(c,1l,D){h 1Z=D?c.t.1B:c.t.1x;h 2V=1v.1C(1Z).2V(1l).1G;d{52:2V,1n:1Z.q,1G:(2V/1Z.q),1y:1Z}}},{p:"2W",n:"z",v:f(c,1l,D){h 2a=1v.1C(D?c.t.1B:c.t.1x).1s(f(r){r=c.o.1T?r[1l]:r;d{l:r,1n:c.u.3h(r)}});d 1v.1C(2a).3e("1n","l").43()["l"]}},{p:"53",n:"z",v:f(c,1l,D){h 2a=1v.1C(D?c.t.1B:c.t.1x).1s(f(r){r=c.o.1T?r[1l]:r;d{l:r,1n:c.u.3h(r)}});d 1v.1C(2a).3e("1n","l").41()["l"]}},{p:"54",n:"z",v:f(c,1q,D){h z=D?c.t.1B:c.t.1x;m(!(1q&&1q.q&&1q.q>0)){d 1v.1C(z)}h 1G=1v.1C(z).55(f(x){F(h i=0;i<1q.q;i++){m(c.o.1T){m(c.u.37(1q[i],x)){d E}}28{m(c.u.1Y(1q[i],x)){d E}}}d K}).1s();d 1v.1C(1G)}},{p:"56",n:"z",v:f(c,1q,D){h z=D?c.t.1B:c.t.1x;m(!(1q&&1q.q&&1q.q>0)){d 1v.1C(z)}h 1G=1v.1C(z).2I(f(x){F(h i=0;i<1q.q;i++){m(c.o.1T){m(c.u.37(1q[i],x)){d E}}28{m(c.u.1Y(1q[i],x)){d E}}}d K}).1s();d 1v.1C(1G)}},{p:"57",n:"z",v:f(c,1q,D){h z=D?c.t.1B:c.t.1x;m(!(1q&&1q.q&&1q.q>0)){d 1v.1C(z)}d 1v.1C(1q.58(1v.1C(z).2I(f(x){F(h i=0;i<1q.q;i++){m(c.o.1T){m(c.u.37(1q[i],x)){d K}}28{m(c.u.1Y(1q[i],x)){d K}}}d E}).1s()))}},{p:"59",n:"z",v:f(c,1O,D){h z=D?c.t.1B:c.t.1x;h 2c=E;d 1v.1C(z).2I(f(1F,u){m(2c){2c=1O(1F,u)}d!2c}).1s()}},{p:"5a",n:"z",v:f(c,1O,D){h z=D?c.t.1B:c.t.1x;h 1P=E;d 1v.1C(z).2I(f(1F,u){m(1P){1P=1O(1F,c.u)}d 1P}).1s()}},{p:"5b",n:"z",v:f(c,3V,1O,1s,D){h z=D?c.t.1B:c.t.1x;1s=1s?1s:f(r,s){d{1S:r,1q:s}};h t=[];c.u.2u(z,f(1F){c.u.2u(3V,f(3x){m(1O(1F,3x)){t.I(1s(1F,3x))}})});d t}}]}};1v=2R 35(3t());1v.38(E);1v.35=f(1D,32){m(32==C){32=E}h 2s=2R 35(3t());m(!32){2s.29={};2s.1u=[]}h 2t=K;m(1D){m(1D.1u){F(h 3I 1I 1D.1u){2s.1u(1D.1u[3I])}}m(1D.29){F(h n 1I 1D.29){2s.3J(1D.29[n])}}m(1D.3a){2t=1D.3a}};2s.38(2t);d 2s}})();',62,327,'||||||||||||query|return||function||var||||value|if|type|state|name|length|||results|helper|method|params|val|_s|selection||_p|null|invert|true|for|cmd|match|push|item|false|v9|v24|v25|v18|v17|v16|v15|v14|v13|v12|when|v11|v10|v23|v8|||||||||||v7|v6|v22|v5|v4|v3|v2|v1|v20|v21|v19|field|val1|count|other|array|compare|arg|select|data|extend|jLinq|util|selected|records|not|val2|remaining|from|settings|action|rec|result|toString|in|high|low|actions|record|output|delegate|take|operator|raw|source|useProperties|index|number|string|namespace|equals|sel||||||empty|dist|_jLinq|else|types|list|desc|skip|target|date|manual|defType|_query|order|clone|try|val1Type|exp|catch|debug|sorting|args|msg|lib|lock|each|trim|sort|obj|gen|repeat|values|ignoreCase|key|join|reverse|altName|or|replace|where|Exception|alias|log|distinct|cache|alt|typeof|add|new|format|generate|str|sum|max|getHours|val2Type|tr|undefined|bool|imp|actual|columns|library|td|propsEqual|finish|all|locked|command|items|sorted|orderBy|doSort|regexp|getNumericValue|performSort|border|found|added|Math|getString|eval|onEvent|lastField|substr|lastCommand|_defaultLibrary|findCmd|slice|removeCmd|sub|use|as|toLowerCase|parseInt|gi|this|col|pk|th|paramCount|ext|addType|class|addCmd|css|splice|table|toRegex|allValues|at|hasCmd|prepCmd|fk|collection|throw|object|and|andNot|orNot|first|appendCmd|last|calling|is|lastCommandName|repeatCmd|loaded|operators|toDateString|useCase|combine|orCombine|setTime|has|getTime|startsWith|endsWith|contains|less|greater|lessEquals|greaterEquals|between|exec|global|betweenEquals|isNot|any|none|boolean|pop|toTable|No|toUpperCase|getMonth|getDate|getFullYear|getMinutes|PM|AM|cellpadding|cellspacing|escape|row|Called|groupBy|break|anyEqual|allEqual|attach|skipTake|RegExp|shift|continue|the|evaluating|properties|showCommands|an|must|extension|average|total|min|except|notWhere|intersect|union|concat|skipWhile|takeWhile|selectMany|Source|Library|removeType|prototype|toTimeString'.split('|'),0,{}))

/* FIN - jLinq */

var borradores = {
	template_borrador: '',
	r: new Array(),
	counts: new Array(),

	filtro: 'todos',
	categoria: 'todas',
	orden: 'titulo',

	filtro_anterior: '',
	categoria_anterior: '',
	orden_anterior: '',

	printResult: function(){
		var el = $('ul#resultados-borradores');
		el.html('');
		$.each(this.r, function(i, borrador){
			var h = borradores.template_borrador.replace('__id__', borrador['id']).replace('__categoria__', borrador['categoria']).replace('__imagen__', borrador['imagen']).replace('__tipo__', borrador['tipo']).replace('__categoria_name__', borrador['categoria_name']).replace('__url__', borrador['url']).replace('__titulo__', borrador['titulo']).replace('__causa__', borrador['causa']).replace('__fecha_guardado__', borrador['fecha_print']).replace('__borrador_id__', borrador['id']);
			if(borrador['tipo']=='borradores')
				h = h.replace('__url__', borrador['url']).replace('__onclick__', '');
			else if(borrador['tipo']=='eliminados')
				h = h.replace('__url__', '').replace('__onclick__', 'borradores.show_eliminado(' + borrador['id'] + '); return false;');

			el.append(h);
			if(borrador['tipo']!='eliminados') //Elimino la causa de los que no son eliminados
				$('ul#resultados-borradores li#borrador_id_' + borrador['id'] + ' span.causa').remove();
		});
	},

	printCounts: function(printCategorias){
		//Filtros
		$('ul#borradores-filtros li#todos span.count').html(this.counts['todos']);
		$('ul#borradores-filtros li#borradores span.count').html(this.counts['borradores']);
		$('ul#borradores-filtros li#eliminados span.count').html(this.counts['eliminados']);

		//Categorias
		$('ul#borradores-categorias li#todas span.count').html(this.counts['todos']);
		$.each(this.counts['categorias'], function(categoria, data){
			if(printCategorias)
				$('ul#borradores-categorias').append('<li id="' + categoria + '"><span class="cat-title"><a href="" onclick="borradores.active(this); borradores.categoria = \'' + categoria + '\'; borradores.query(); return false;">' + data['name'] + '</a></span> <span class="count">' + data['count'] + '</span></li>');
			else
				$('ul#borradores-categorias li#' + categoria + ' span.count').html(data['count']);
		});
	},

	query: function(force_no_parcial){
		//force_no_parcial[boolean] = true => No hace la busqueda parcial. false -> Dependiendo del caso, determina si usa la busqueda parcial o no.

		//Determinacion de busqueda parcial o no
		var parcial = false;
		if(!force_no_parcial){
			//Filtro
			if(this.filtro_anterior != this.filtro){
				parcial = (this.filtro_anterior == 'todos');
			}
			//Categoria
			else if(this.categoria_anterior != this.categoria){
				parcial = (this.categoria_anterior == 'todas');
			}
			//Orden
			else if(this.orden_anterior != this.orden){
				parcial = true;
			}
			//Search
			else if(this.search_q_anterior != this.search_q){
				//Calcula por la busqueda anterior si tiene que hacer una busqueda parcial
				var re = new RegExp(this.search_q_anterior);
				parcial = re.test(this.search_q);
			}
		}

		//Si esta vacio no realizo ninguna consulta
		if((parcial && this.r.length==0) || (!parcial && borradores_data.length == 0)){
			this.filtro_anterior = this.filtro;
			this.categoria_anterior = this.categoria;
			this.orden_anterior = this.orden;
			this.search_q_anterior = this.search_q;
			return;
		}

		this.r = jLinq.from(parcial ? this.r : borradores_data);

		//Filtro
		if(this.filtro != 'todos' && (!parcial || this.filtro_anterior != this.filtro))
			this.r = this.r.equals('tipo', this.filtro);

		//Categoria
		if(this.categoria != 'todas' && (!parcial || this.categoria_anterior != this.categoria))
			this.r = this.r.equals('categoria', this.categoria);

		//Search
		if(!empty(this.search_q) && (!parcial || this.search_q_anterior != this.search_q))
			this.r = this.r.contains('titulo', this.search_q);

		//Ordenar por
		if(!parcial || this.orden_anterior != this.orden)
			this.r = this.r.orderBy(this.orden);

		this.r = this.r.select();

		this.filtro_anterior = this.filtro;
		this.categoria_anterior = this.categoria;
		this.orden_anterior = this.orden;
		this.search_q_anterior = this.search_q;

		this.printResult();
	},

	//Buscador
	search_q: '',
	search_q_anterior: '',
	search: function(q, event){
		tecla = (document.all) ? event.keyCode:event.which;
		if(tecla==27){ //Escape, limpio input
			q = '';
			$('#borradores-search').val('');
		}
		if(q == this.search_q)
			return;
		//Calcula por la busqueda anterior si tiene que hacer una busqueda parcial
		this.search_q = q;
		this.query();
	},
	search_focus: function(){
		$('label[for="borradores-search"]').hide();
	},
	search_blur: function(){
		if(empty($('#borradores-search').val()))
			$('label[for="borradores-search"]').show();
	},

	active: function(e){
		$(e).parent().parent().parent().children('li').removeClass('active');
		$(e).parent().parent().addClass('active');
	},

	eliminar: function(id, dialog){
		mydialog.close();
		if(dialog){
			mydialog.show();
			mydialog.title('Eliminar Borrador');
			mydialog.body('&iquest;Seguro que deseas eliminar este borrador?');
			mydialog.buttons(true, true, 'SI', 'borradores.eliminar(' + id + ', false)', true, false, true, 'NO', 'close', true, true);
			mydialog.center();
		}else{
		  $('#loading').fadeIn(250);
			$.ajax({
				type: 'POST',
				url: global_data.url + '/borradores-eliminar.php',
				data: 'borrador_id=' + id,
				success: function(h){
					switch(h.charAt(0)){
						case '0': //Error
							mydialog.alert('Error', h.substring(3));
							break;
						case '1':
							$('li#borrador_id_' + id).fadeOut('normal', function(){ $(this).remove(); });
							//Quedaba solo un borrador
							if(borradores_data.length==1)
								$('div#borradores div#res').html('<div class="emptyData">No tienes ning&uacute;n borrador ni post eliminado</div>');

							//Lo elimino de borradores_data
							for(var i=0; i<borradores_data.length; i++){
								if(borradores_data[i]['id']==id){
									//Hago los descuentos de contadores
									borradores.counts['todos']--;
									borradores.counts[borradores_data[i]['tipo']]--;
									borradores.counts['categorias'][borradores_data[i]['categoria']]['count']--;

									borradores_data.splice(i, 1);
									break;
								}
							}

							//Lo elimino de borradores.r
							for(var i=0; i<borradores.r.length; i++){
								if(borradores.r[i]['id']==id){
									borradores.r.splice(i, 1);
									break;
								}
							}

							//Actualizo contadores
							borradores.printCounts();
							break;
					}
                    $('#loading').fadeOut(350);
				},
				error: function(){	
					mydialog.alert('Error', 'Hubo un error al intentar procesar lo solicitado');
                    $('#loading').fadeOut(350);
				}
			});
		}
	},

	show_eliminado: function(id){
		mydialog.show();
		mydialog.title('Cargando Post');
		mydialog.body('Cargando Post...', 200);
		mydialog.buttons(true, true, 'Aceptar', 'close', true, true, false);
		mydialog.center();
		mydialog.procesando_inicio();
        $('#loading').fadeIn(250);
		$.ajax({
			type: 'POST',
			url: global_data.url + '/borradores-get.php',
			data: 'borrador_id=' + id,
			success: function(h){
				switch(h.charAt(0)){
					case '0': //Error
						mydialog.alert('Error', h.substring(3));
						break;
					case '1':
						mydialog.title('Post');
						mydialog.body(h.substring(3), 540);
						mydialog.buttons(true, true, 'Aceptar', 'close', true, true, false);
						mydialog.center();
						break;
				}
                $('#loading').fadeOut(350);
			},
			error: function(){	
				mydialog.alert('Error', 'Hubo un error al intentar procesar lo solicitado');
                $('#loading').fadeOut(350);
			},
			complete: function(){
				mydialog.procesando_fin();
                $('#loading').fadeOut(350);
			}
		});
	}
}

function sortObject(o){
	var sorted = {}, key, a = [];
	for(key in o)
		if(o.hasOwnProperty(key))
			a.push(key);
	a.sort();
	for(key = 0; key < a.length; key++)
		sorted[a[key]] = o[a[key]];
	return sorted;
}


$(document).ready(function(){
	//Guardo el template en una variable
	borradores.template_borrador = $('#template-result-borrador').html();
	$('#template-result-borrador').remove();

	//Inicializo contadores
	borradores.counts = {'todos': 0, 'borradores':0, 'eliminados':0, 'categorias': {}};

	//Hago conteo inicial
	$.each(borradores_data, function(i, borrador){
		borradores.counts['todos']++;
		borradores.counts[borrador['tipo']]++;
		if(borradores.counts['categorias'][borrador['categoria']])
			borradores.counts['categorias'][borrador['categoria']]['count']++;
		else{
			borradores.counts['categorias'][borrador['categoria']] = {'name': borrador['categoria_name'], 'count':1};
		}
	});
	borradores.counts['categorias'] = sortObject(borradores.counts['categorias']);

	//Imprimo los contadores
	borradores.printCounts(true);

	//Query inicial
	borradores.query(true);
});