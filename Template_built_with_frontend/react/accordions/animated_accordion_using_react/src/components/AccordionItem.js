import React from "react";
class AccordionItem extends React.Component {
  constructor(props) {
    super(props);
    this.handleToggleVisibility = this.handleToggleVisibility.bind(this);
    // the state to store and restore status of accordion_content
    // If visibility was true, the description of accordion visualize
    this.state = {
      visibility: false,
    };
  }
  handleToggleVisibility() {
    this.setState((prevState) => {
      return {
        visibility: !prevState.visibility,
      };
    });
  }
  render() {
    const activeStatus = this.state.visibility ? "active" : "";
    return (
      <div>
        <button
          className="accordion_button"
          onClick={this.handleToggleVisibility}
        >
          {this.props.hiddenText.label}
          <span
            className={this.state.visibility ? "fas fa-minus" : "fas fa-plus"}
          ></span>
        </button>
        <p className={`accordion_content ${activeStatus}`}>
          {this.props.hiddenText.value}
        </p>
      </div>
    );
  }
}
export default AccordionItem;
