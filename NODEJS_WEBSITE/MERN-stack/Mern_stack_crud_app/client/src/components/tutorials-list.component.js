import React, { Component } from "react";
import TutorialDataService from "../services/tutorial.service";
import { Link } from "react-router-dom";
export default class TutorialsList extends Component {
  constructor(props) {
    super(props);
    this.state.onChangeSearchTitle = this.onChangeSearchTitle.bind(this);
    this.retrieveTutorials = this.retrieveTutorials.bind(this);
    this.refreshLists = this.refreshLists.bind(this);
  }
}
