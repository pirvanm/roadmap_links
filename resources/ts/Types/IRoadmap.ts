import { IRoadmapNode } from "./IRoadmapNode";
import { ITag } from "./ITag";

export interface IRoadmap
{
    id: number | null;
    tag: ITag,
    mainNode: IRoadmapNode,
    name: string | null;
    status: boolean;
    created_at: string;
}