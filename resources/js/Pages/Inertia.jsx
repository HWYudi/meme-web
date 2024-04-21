import { difference } from "lodash";
import React from "react";

export default function Inertia({ posts }) {
    console.log(posts);
    return (
        <div>
            {posts.map((post) => (
                <div
                    key={post.id}
                    className="border-t border-[#2E2E2E] py-4 my-10"
                >
                    <div className="flex gap-2 relative">
                        <div className="absolute top-0 right-0">
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M6 14C7.10457 14 8 13.1046 8 12C8 10.8954 7.10457 10 6 10C4.89543 10 4 10.8954 4 12C4 13.1046 4.89543 14 6 14ZM14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12ZM20 12C20 13.1046 19.1046 14 18 14C16.8954 14 16 13.1046 16 12C16 10.8954 16.8954 10 18 10C19.1046 10 20 10.8954 20 12Z"
                                    fill="white"
                                />
                            </svg>
                        </div>
                        <img
                            src={`/storage/${post.user.image}`}
                            alt="Post Image"
                            className="w-12 h-12 rounded-full"
                        />
                        <div>
                            <h1 className="font-semibold">{post.user.name}</h1>
                            <p>{post.title}</p>
                            <img
                                src={`/storage/${post.body}`}
                                alt=""
                                className="w-full my-3 rounded-lg"
                            />
                            <div className="flex pt-2 gap-5 items-center">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M3.58447 12.941L11.2674 21.2113C11.663 21.6372 12.337 21.6372 12.7326 21.2113L20.4155 12.941C22.5282 10.6669 22.5282 6.97976 20.4155 4.70561C18.3029 2.43146 14.8777 2.43146 12.765 4.70561L12.7326 4.74049C12.337 5.16635 11.663 5.16635 11.2674 4.74049L11.235 4.70561C9.12233 2.43146 5.69709 2.43146 3.58447 4.70561C1.47184 6.97976 1.47184 10.6669 3.58447 12.941Z"
                                        stroke="white"
                                        stroke-width="2"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <mask
                                        id="path-1-outside-1_0_308"
                                        maskUnits="userSpaceOnUse"
                                        x="1.99402"
                                        y="2"
                                        width="21"
                                        height="21"
                                        fill="black"
                                    >
                                        <rect
                                            fill="white"
                                            x="1.99402"
                                            y="2"
                                            width="21"
                                            height="21"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M17.9777 17.3318C19.2393 15.9168 20.006 14.0509 20.006 12.006C20.006 7.5844 16.4216 4 12 4C7.57842 4 3.99402 7.5844 3.99402 12.006C3.99402 16.4276 7.57842 20.012 12 20.012C13.521 20.012 14.9429 19.5878 16.1539 18.8514L18.4073 19.3347L17.9777 17.3318Z"
                                        />
                                    </mask>
                                    <path
                                        d="M17.9777 17.3318L16.4849 16.0008L15.8092 16.7586L16.0222 17.7513L17.9777 17.3318ZM16.1539 18.8514L16.5734 16.8958L15.795 16.7289L15.1148 17.1425L16.1539 18.8514ZM18.4073 19.3347L17.9878 21.2902L21.0114 21.9388L20.3628 18.9152L18.4073 19.3347ZM18.006 12.006C18.006 13.5414 17.4325 14.938 16.4849 16.0008L19.4705 18.6628C21.0461 16.8956 22.006 14.5605 22.006 12.006H18.006ZM12 6C15.317 6 18.006 8.68897 18.006 12.006H22.006C22.006 6.47983 17.5262 2 12 2V6ZM5.99402 12.006C5.99402 8.68897 8.68299 6 12 6V2C6.47385 2 1.99402 6.47983 1.99402 12.006H5.99402ZM12 18.012C8.68299 18.012 5.99402 15.323 5.99402 12.006H1.99402C1.99402 17.5321 6.47385 22.012 12 22.012V18.012ZM15.1148 17.1425C14.208 17.6939 13.1442 18.012 12 18.012V22.012C13.8978 22.012 15.6778 21.4817 17.1931 20.5602L15.1148 17.1425ZM15.7345 20.8069L17.9878 21.2902L18.8268 17.3792L16.5734 16.8958L15.7345 20.8069ZM20.3628 18.9152L19.9332 16.9123L16.0222 17.7513L16.4518 19.7542L20.3628 18.9152Z"
                                        fill="white"
                                        mask="url(#path-1-outside-1_0_308)"
                                    />
                                </svg>
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M10 12L11.7281 19.7764C11.8261 20.2174 12.4125 20.3126 12.6449 19.9251L20.5457 6.75725C20.7456 6.42399 20.5056 6 20.1169 6H4.35163C3.88743 6 3.67378 6.57753 4.02623 6.87963L10 12ZM10 12L20 6.5"
                                        stroke="white"
                                        stroke-width="2"
                                    />
                                </svg>
                            </div>
                            <h1>{post.comment.length} Balasan</h1>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
}
