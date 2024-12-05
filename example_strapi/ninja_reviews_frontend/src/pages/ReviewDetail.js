import React from "react";
import { useParams } from "react-router-dom";
import { useQuery, gql } from "@apollo/client";
const REVIEW = gql`
  query GetReview($id: ID!) {
    reviews(id: $id) {
      title
      body
      rating
      id
      categories {
        id
        name
      }
    }
  }
`;
export default function ReviewDetail() {
  const { id } = useParams();
  const { loading, error, data } = useQuery(REVIEW, {
    variables: {
      id: id,
    },
  });
  if (loading) {
    return <p>Loading...</p>;
  }
  if (error) {
    return <p>Error: {error}</p>;
  }
  return (
    <div className="review-card">
      <div>
        <div key={data.id} className="review-card">
          <div className="rating">{data.review.rating}</div>
          <h2>{data.review.title}</h2>
          {data.review.categories.map((c) => (
            <small key={c.id}>{c.name}</small>
          ))}
          <p>{data.review.body}</p>
        </div>
      </div>
    </div>
  );
}
