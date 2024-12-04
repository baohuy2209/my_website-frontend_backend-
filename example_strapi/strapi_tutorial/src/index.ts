// import type { Core } from '@strapi/strapi';
const conditions = [
  {
    displayName: "Entity has same name as user",
    name: "same-name-as-user",
    plugin: "name of a plugin if created in a plugin",
    handler: (user) => {
      return {
        name: user.name,
      };
    },
  },
  {
    displayName: "Email address from strapi.io",
    name: "email-strapi-dot-io",
    async handler(user) {
      return user.email.includes("@strapi.io");
    },
  },
];
export default async () => {
  await strapi.admin.services.permission.conditionProvider.registerMany(
    conditions
  );
};
