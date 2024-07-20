import React from "react";
import user from "../images/th.jfif";
const CardContact = (props) => {
  const { id, name, email } = props.contact;
  return (
    <div className="item">
      <img className="ui avatar image" src={user} alt="user" />
      <div className="content">
        <div className="header">{name}</div>
        <div>{email}</div>
      </div>
      <div className="ui right">
        <i
          className="trash alternate outline icon"
          onClick={() => props.clickHandler(id)}
        ></i>
      </div>
    </div>
  );
};
export default CardContact;
