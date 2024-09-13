import * as React from "react";
import tutorialService from "../service/tutorial.service";
import ITutorialData from "../types/tutorial.type";
export interface IAddTutorialsProps {}
type State = ITutorialData & {
  submitted: boolean;
};
export default class AddTutorials extends React.Component<
  IAddTutorialsProps,
  State
> {
  constructor(props: IAddTutorialsProps) {
    super(props);
    this.onChangeTitle = this.onChangeTitle.bind(this);
    this.onChangeDescription = this.onChangeDescription.bind(this);
    this.saveTutorial = this.saveTutorial.bind(this);
    this.newTutorial = this.newTutorial.bind(this);
    this.state = {
      id: null,
      title: "",
      description: "",
      published: false,
      submitted: false,
    };
  }
  onChangeTitle(e: React.ChangeEvent<HTMLInputElement>) {
    this.setState({
      title: e.target.value,
    });
  }
  onChangeDescription(e: React.ChangeEvent<HTMLInputElement>) {
    this.setState({
      description: e.target.value,
    });
  }
  saveTutorial() {
    const data: ITutorialData = {
      title: this.state.title,
      description: this.state.description,
    };
    tutorialService
      .create(data)
      .then((response: any) => {
        this.setState({
          id: response.data.id,
          title: response.data.title,
          description: response.data.description,
          published: response.data.published,
          submitted: true,
        });
        console.log(response.data);
      })
      .catch((e: Error) => {
        console.log(e);
      });
  }
  newTutorial() {
    this.setState({
      id: null,
      title: "",
      description: "",
      published: false,
      submitted: false,
    });
  }
  public render() {
    const { submitted, title, description } = this.state;
    return (
      <div className="submit-form">
        {submitted ? (
          <div>
            <h4>You submited succefully!</h4>
            <button className="btn btn-success" onClick={this.newTutorial}>
              Add
            </button>
          </div>
        ) : (
          <form>
            <div className="form-group">
              <label htmlFor="title">Title</label>
              <input
                type="text"
                className="form-control"
                id="title"
                name="title"
                required
                value={title}
                onChange={this.onChangeTitle}
              />
            </div>
            <div className="form-group">
              <label htmlFor="title">Title</label>
              <input
                type="text"
                className="form-control"
                id="title"
                name="title"
                required
                value={title}
                onChange={this.onChangeTitle}
              />
            </div>
            <button onClick={this.saveTutorial} className="btn btn-success">
              Submit
            </button>
          </form>
        )}
      </div>
    );
  }
}
