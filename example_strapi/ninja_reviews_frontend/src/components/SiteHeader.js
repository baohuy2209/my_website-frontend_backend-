import React from "react";
import { Link } from "react-router-dom";
import { useQuery, gql } from "@apollo/client";
const CATEGORY_REVIEW = gql`
  query GetCategories {
    categoryReview {
      Name
      id
    }
  }
`;
export default function SiteHeader() {
  const { loading, error, data } = useQuery(CATEGORY_REVIEW);
  if (loading) {
    return <p>Loading ...</p>;
  }
  if (error) {
    return <p>Error: </p>;
  }
  console.log(data);
  return (
    <div className="site-header">
      <Link to="/">
        <h1>Ninja Reviews</h1>
      </Link>
      <nav className="categories">
        <span>Filter reviews by category:</span>
        {data.categories.map((category) => (
          <Link key={category.id} to={`/category/${category.id}`}>
            {category.name}
          </Link>
        ))}
      </nav>
    </div>
  );
}
