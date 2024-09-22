import firebase from "firebase/app";
import "firebase/firestore";
let config = {
  apiKey: "xxx",
  authDomain: "baohuy-firebase.firebaseapp.com",
  databaseURL: "https://baohuy-firebase.firebaseio.com",
  projectId: "baohuy-firebase",
  storageBucket: "baohuy-firebase.appspot.com",
  messagingSenderId: "xxx",
  appId: "xxx",
};
firebase.initializeApp(config);
export default firebase.firestore();
