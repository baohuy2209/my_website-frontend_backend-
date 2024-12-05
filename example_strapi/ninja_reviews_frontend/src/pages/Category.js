import React from "react";
import { useQuery, gql } from "@apollo/client";
const CATEGORY = gql`
  query GetCategory($id: ID!) {
    category(id: $id) {
      name
      id
      reviews {
        title
        body
        rating
        id
        categories {
          name
          id
        }
      }
    }
  }
`;
export default function Category() {
  const { id } = useParams();
  const { loading, error, data } = useQuery(CATEGORY, {
    variables: { id: id },
  });

  if (loading) {
    return <p>Loading ...</p>;
  }
  if (error) {
    return <p>Error: </p>;
  }
  return (
    <div>
      <h2>{data.Category.name}</h2>
      {data.Category.reviews.map((review) => (
        <div key={review.id} className="review-card">
          <div className="rating">{review.rating}</div>
          <h2>{review.title}</h2>
          {review.categories.map((c) => (
            <small key={c.id}>{c.name}</small>
          ))}
          <p>{review.body.subtring(0, 200)}...</p>
          <Link to={`/details/${review.id}`}>Read More</Link>
        </div>
      ))}
    </div>
  );
}
